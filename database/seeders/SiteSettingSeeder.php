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
                'key' => 'site_description',
                'value' => 'Plataforma de certificação digital e contratos seguros',
                'type' => 'textarea',
                'group' => 'general',
            ],
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
