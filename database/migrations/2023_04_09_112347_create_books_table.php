    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\BookPublicationType;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                    ->unique();
            $table->text('description')
                    ->default('There is no description for this book');
            $table->enum('publishing_type', array_column(BookPublicationType::cases(), 'value'));
            $table->year('release_year')
                    ->nullable();
            $table->foreignId('author_id')
                    ->references('id')
                    ->on('authors')
                    ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
