<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Configurações gerais
            [
                'key' => 'site_name',
                'value' => 'Trust-me',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'site_slogan',
                'value' => 'Plataforma de Certificação Digital',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'site_description',
                'value' => 'Plataforma de certificação digital e contratos seguros',
                'type' => 'textarea',
                'group' => 'general',
            ],
            
            // Configurações da tela Home
            [
                'key' => 'home.hero_title',
                'value' => 'Certificação Digital e Contratos Seguros',
                'type' => 'text',
                'group' => 'home',
            ],
            [
                'key' => 'home.hero_subtitle',
                'value' => 'Aumente a confiança dos seus clientes com nossos selos digitais e contratos seguros',
                'type' => 'textarea',
                'group' => 'home',
            ],
            [
                'key' => 'home.cta_primary_label',
                'value' => 'Começar Agora',
                'type' => 'text',
                'group' => 'home',
            ],
            [
                'key' => 'home.cta_secondary_label',
                'value' => 'Ver Planos',
                'type' => 'text',
                'group' => 'home',
            ],
            [
                'key' => 'home.cta_block_title',
                'value' => 'Pronto para Começar?',
                'type' => 'text',
                'group' => 'home',
            ],
            [
                'key' => 'home.cta_block_subtitle',
                'value' => 'Junte-se a milhares de empresas que já confiam no Trust-me',
                'type' => 'textarea',
                'group' => 'home',
            ],
            
            // Configurações de contato
            [
                'key' => 'contact_email',
                'value' => 'contato@trustme.com',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_phone',
                'value' => '(11) 99999-9999',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Rua das Empresas, 123 - São Paulo, SP',
                'type' => 'textarea',
                'group' => 'contact',
            ],
            
            // Configurações de pagamento
            [
                'key' => 'mercado_pago_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'payment',
            ],
            [
                'key' => 'mercado_pago_public_key',
                'value' => '',
                'type' => 'text',
                'group' => 'payment',
            ],
            [
                'key' => 'mercado_pago_access_token',
                'value' => '',
                'type' => 'text',
                'group' => 'payment',
            ],
            
            // Configurações de email
            [
                'key' => 'email_notifications_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'email',
            ],
            [
                'key' => 'welcome_email_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'email',
            ],
            
            // Configurações de SEO
            [
                'key' => 'meta_keywords',
                'value' => 'certificação digital, contratos digitais, selo de confiança, segurança digital',
                'type' => 'textarea',
                'group' => 'seo',
            ],
            [
                'key' => 'meta_description',
                'value' => 'Trust-me oferece certificação digital e contratos seguros para empresas. Aumente a confiança dos seus clientes com nossos selos digitais.',
                'type' => 'textarea',
                'group' => 'seo',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::create($setting);
        }
    }
}
