<?php

namespace Tests\Unit\Application;

use App\Application\FetchUploadedFilesQuery;
use App\Domain\Repositories\UploadedFileRepository;
use Mockery;
use PHPUnit\Framework\TestCase;

class FetchUploadedFilesQueryTest extends TestCase
{
    public function test_execute_should_return_correct_repository_return()
    {
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

        $repository = Mockery::mock(UploadedFileRepository::class);
        $repository->shouldReceive('findFiltered')->once()->with(123, 'test', 'active', '2024-06-09', 1)->andReturn($expectedReturn);

        $query = new FetchUploadedFilesQuery($repository);

        $result = $query->execute(123, 'test', 'active', '2024-06-09', 1);

        // Verifique se o método findFiltered do repositório foi chamado corretamente e se retornou um array vazio
        $this->assertEquals($expectedReturn, $result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
