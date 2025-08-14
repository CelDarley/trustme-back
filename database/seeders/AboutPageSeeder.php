<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        $aboutSettings = [
            [
                'key' => 'about.hero_title',
                'value' => 'Sobre o Trust-me',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about.hero_subtitle',
                'value' => 'Somos uma empresa dedicada a transformar a forma como as equipes colaboram e gerenciam seus projetos, oferecendo soluções inovadoras e confiáveis.',
                'type' => 'textarea',
                'group' => 'about',
            ],
            [
                'key' => 'about.mission_title',
                'value' => 'Nossa Missão',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about.mission_text',
                'value' => 'Capacitar empresas de todos os tamanhos com ferramentas intuitivas e poderosas que simplificam a gestão de projetos e potencializam a colaboração em equipe.',
                'type' => 'textarea',
                'group' => 'about',
            ],
            [
                'key' => 'about.mission_text_2',
                'value' => 'Acreditamos que a tecnologia deve ser um facilitador, não um obstáculo. Por isso, desenvolvemos soluções que são ao mesmo tempo sofisticadas e fáceis de usar.',
                'type' => 'textarea',
                'group' => 'about',
            ],
            [
                'key' => 'about.values_title',
                'value' => 'Nossos Valores',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about.values_text',
                'value' => 'Nossa empresa é fundamentada em valores sólidos que guiam todas as nossas ações e decisões. Acreditamos que a confiança é a base de todos os relacionamentos, a inovação nos impulsiona a buscar soluções melhores, a simplicidade nos permite resolver complexidades de forma clara, e a excelência é nosso compromisso em tudo que fazemos.',
                'type' => 'textarea',
                'group' => 'about',
            ],
            [
                'key' => 'about.team_title',
                'value' => 'Nossa Equipe',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about.team_subtitle',
                'value' => 'Profissionais apaixonados por tecnologia e dedicados a criar as melhores soluções para nossos clientes.',
                'type' => 'textarea',
                'group' => 'about',
            ],
            [
                'key' => 'about.team_text',
                'value' => 'Nossa equipe é composta por profissionais experientes e apaixonados por tecnologia. Trabalhamos com metodologias ágeis, sempre focados na qualidade e na experiência do usuário. Cada membro da nossa equipe contribui com sua expertise única para criar soluções inovadoras e eficientes.',
                'type' => 'textarea',
                'group' => 'about',
            ],
            [
                'key' => 'about.history_title',
                'value' => 'Nossa História',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about.cta_title',
                'value' => 'Faça parte da nossa história',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about.cta_subtitle',
                'value' => 'Junte-se a milhares de empresas que já confiam no Trust-me para gerenciar seus projetos e alcançar seus objetivos.',
                'type' => 'textarea',
                'group' => 'about',
            ],
            [
                'key' => 'about.cta_button',
                'value' => 'Começar Agora',
                'type' => 'text',
                'group' => 'about',
            ],
        ];

        foreach ($aboutSettings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Configurações da página Sobre criadas/atualizadas com sucesso!');
    }
} 