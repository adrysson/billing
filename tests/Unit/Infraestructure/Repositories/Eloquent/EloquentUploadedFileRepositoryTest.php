<?php

namespace Tests\Unit\Infraestructure\Repositories\Eloquent;

use App\Domain\Factories\UploadedFileFactory;
use App\Domain\ValueObjects\UploadedFileId;
use App\Infraestructure\Models\UploadedFile;
use App\Infraestructure\Repositories\Eloquent\EloquentUploadedFileRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entities\UploadedFileStub;

class EloquentUploadedFileRepositoryTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_store_should_add_id_when_not_has_error()
    {
        $uploadedFile = UploadedFileStub::random();

        $model = Mockery::mock(UploadedFile::class);
        $model->shouldIgnoreMissing();
        $model->shouldReceive('newInstance')->andReturnSelf();
        $model->shouldReceive('save');
        $model->shouldReceive('getAttribute')
            ->with('id')
            ->andReturn(1);

        $repository = new EloquentUploadedFileRepository($model);

        $repository->store($uploadedFile);

        $this->assertInstanceOf(UploadedFileId::class, $uploadedFile->id());
        $this->assertEquals(1, $uploadedFile->id()->value);
    }

    public function test_update_should_change_data_when_not_has_error()
    {
        $model = Mockery::mock(UploadedFile::class);
        $model->shouldReceive('where')->with('id', 1)->andReturnSelf();
        $model->shouldReceive('update')->once();

        $stub = UploadedFileStub::random();

        $uploadedFile = UploadedFileFactory::new(
            fileName: $stub->name->value,
            realPath: $stub->realPath->value,
        );

        $uploadedFile->created(new UploadedFileId(1));

        $repository = new EloquentUploadedFileRepository($model);

        $repository->update($uploadedFile);
    }

    public function test_find_filtered_should_return_LengthAwarePaginator()
    {
        $model = Mockery::mock(UploadedFile::class);
        $model->shouldReceive('query')->andReturnSelf();
        $model->shouldReceive('where')->with('id', 123)->andReturnSelf()->once();
        $model->shouldReceive('where')->with('name', 'like', '%test%')->andReturnSelf()->once();
        $model->shouldReceive('where')->with('status', 'active')->andReturnSelf()->once();
        $model->shouldReceive('whereDate')->with('created_at', '2024-06-09')->andReturnSelf()->once();

        $paginator = Mockery::mock(LengthAwarePaginator::class);

        $expectedReturn = [
            "current_page" => 1, 
            "data" => [
                [
                    "id" => 2, 
                    "name" => "input.csv", 
                    "real_path" => "/tmp/phpfdkcKi", 
                    "status" => 3, 
                    "created_at" => "2024-06-09T05:13:50.000000Z", 
                    "updated_at" => "2024-06-09T05:13:52.000000Z" 
                ],
                [
                    "id" => 3, 
                    "name" => "input.csv", 
                    "real_path" => "/tmp/phpdpjPhE", 
                    "status" => 3, 
                    "created_at" => "2024-06-09T05:13:55.000000Z", 
                    "updated_at" => "2024-06-09T05:13:58.000000Z" 
                ],
                [
                    "id" => 4, 
                    "name" => "input.csv", 
                    "real_path" => "/tmp/phpiJpeOe", 
                    "status" => 3, 
                    "created_at" => "2024-06-09T05:14:13.000000Z", 
                    "updated_at" => "2024-06-09T05:14:16.000000Z" 
                ],
                [
                    "id" => 5, 
                    "name" => "input.csv", 
                    "real_path" => "/tmp/phpfnEcfm", 
                    "status" => 1, 
                    "created_at" => "2024-06-09T05:17:27.000000Z", 
                    "updated_at" => "2024-06-09T05:17:27.000000Z" 
                ],
            ], 
            "first_page_url" => "http://localhost:8000/uploaded-files?page=1", 
            "from" => 1,
            "last_page" => 1, 
            "last_page_url" => "http://localhost:8000/uploaded-files?page=1", 
            "links" => [
                [
                    "url" => null, 
                    "label" => "&laquo; Previous", 
                    "active" => false,
                ], 
                [
                    "url" => "http://localhost:8000/uploaded-files?page=1", 
                    "label" => "1", 
                    "active" => true,
                ], 
                [
                    "url" => null, 
                    "label" => "Next &raquo;", 
                    "active" => false,
                ],
            ], 
            "next_page_url" => null, 
            "path" => "http://localhost:8000/uploaded-files", 
            "per_page" => 10, 
            "prev_page_url" => null, 
            "to" => 4, 
            "total" => 4 
        ];

        $paginator->shouldReceive('toArray')->andReturn($expectedReturn);

        $model->shouldReceive('paginate')->andReturn($paginator);

        $repository = new EloquentUploadedFileRepository($model);

        $result = $repository->findFiltered(123, 'test', 'active', '2024-06-09', 1);

        $this->assertEquals($expectedReturn, $result);
    }
}
