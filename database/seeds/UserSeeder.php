use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{

public function run()
{
User::create([
'name' => 'Admin User',
'email' => 'admin@example.com',
'password' => bcrypt('adminpassword'),
'user_type' => 'admin',
]);
}
}
}