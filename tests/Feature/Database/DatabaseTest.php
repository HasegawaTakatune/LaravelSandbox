<?php

namespace Tests\Feature\Database;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use App\Models\Book;

class DatabaseTest extends TestCase
{
    // テスト後にデータを破棄してくれる
    use RefreshDatabase;

    // ./vendor/bin/phpunit tests/Feature/Database/DatabaseTest.php とコマンドを打ってテストを実行する。

    public function test_database(): void
    {
        // 各チェックにエラー時のメッセージを書いていればいいが、書かれていない場合で1メソッドに複数検証している場合は
        // エラーが起きている箇所の特定がしにくい。１メソッド・１検証にするか、1メソッド内に複数検証している場合は
        // エラー時のメッセージを原則書くようにした方がいい？
        $this->assertTrue(Schema::hasColumns('books', ['id', 'title', 'author']), 'Booksテーブルが存在しない、またはカラムが存在しません。');

        // テーブル保存　テスト方法１
        // $book = new Book();
        // $book->title = 'foo';
        // $book->author = 'bar';
        // $result = $book->save();
        // $this->assertTrue($result, 'Booksテーブルへの保存に失敗しました。');
        
        // テーブル保存　テスト方法２
        // $book = ['title' => 'foo', 'author' => 'bar'];
        // Book::factory()->create($book);
        // $this->assertDatabaseHas('books', $book);

        // テーブル保存　テスト方法３
        $books = Book::factory(3)->create();
        $result = count($books) == 3;
        $this->assertTrue($result, 'Booksテーブルにレコードだ追加できていません。');

    }


}
