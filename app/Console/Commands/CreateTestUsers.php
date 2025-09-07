<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateTestUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:test-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria usuários de teste: jose@trustme.com (usuário comum) e admin@trustme.com (admin)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Criando usuários de teste...');
        
        // Criar usuário comum
        $this->createUser(
            'José Silva',
            'jose@trustme.com',
            'jose123',
            'user'
        );
        
        // Criar usuário admin
        $this->createUser(
            'Admin TrustMe',
            'admin@trustme.com',
            'admin123',
            'admin'
        );
        
        $this->info('');
        $this->info('✅ Usuários de teste criados com sucesso!');
        $this->info('');
        $this->info('👤 Usuário Comum:');
        $this->info('   Email: jose@trustme.com');
        $this->info('   Senha: jose123');
        $this->info('');
        $this->info('👨‍💼 Usuário Admin:');
        $this->info('   Email: admin@trustme.com');
        $this->info('   Senha: admin123');
        $this->info('');
    }
    
    private function createUser($name, $email, $password, $role)
    {
        // Verificar se o usuário já existe
        $existingUser = User::where('email', $email)->first();
        
        if ($existingUser) {
            $this->warn("⚠️  Usuário {$email} já existe. Atualizando senha...");
            $existingUser->update([
                'name' => $name,
                'password' => Hash::make($password),
                'role' => $role
            ]);
            $this->info("✅ Usuário {$email} atualizado.");
        } else {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => $role,
                'email_verified_at' => now(),
            ]);
            $this->info("✅ Usuário {$email} criado.");
        }
    }
}
