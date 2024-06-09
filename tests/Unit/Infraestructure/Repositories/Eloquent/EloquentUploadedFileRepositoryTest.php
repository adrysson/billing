<?php

namespace Tests\Unit\Infraestructure\Repositories\Eloquent;

use App\Domain\Factories\UploadedFileFactory;
use App\Domain\ValueObjects\UploadedFileId;
use App\Infraestructure\Models\UploadedFile;
use App\Infraestructure\Repositories\Eloquent\EloquentUploadedFileRepository;
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
}
