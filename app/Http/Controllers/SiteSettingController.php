<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteSettingController extends Controller
{
    public function index(Request $request)
    {
        $settings = SiteSetting::when($request->group, function($query, $group) {
                return $query->where('group', $group);
            })
            ->orderBy('group')
            ->orderBy('key')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $settings
        ]);
    }

    public function show($key)
    {
        $setting = SiteSetting::where('key', $key)->first();
        
        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Configuração não encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $setting
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required|string|unique:site_settings,key',
            'value' => 'nullable|string',
            'type' => 'in:text,textarea,boolean,json',
            'group' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $setting = SiteSetting::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $setting,
            'message' => 'Configuração criada com sucesso'
        ], 201);
    }

    public function update(Request $request, $key)
    {
        $setting = SiteSetting::where('key', $key)->first();
        
        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Configuração não encontrada'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'value' => 'nullable|string',
            'type' => 'in:text,textarea,boolean,json',
            'group' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $setting->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $setting,
            'message' => 'Configuração atualizada com sucesso'
        ]);
    }

    public function destroy($key)
    {
        $setting = SiteSetting::where('key', $key)->first();
        
        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Configuração não encontrada'
            ], 404);
        }

        $setting->delete();

        return response()->json([
            'success' => true,
            'message' => 'Configuração excluída com sucesso'
        ]);
    }

    public function bulkUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        foreach ($request->settings as $settingData) {
            SiteSetting::updateOrCreate(
                ['key' => $settingData['key']],
                ['value' => $settingData['value']]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Configurações atualizadas com sucesso'
        ]);
    }

    public function getSiteContent()
    {
        // Buscar todas as configurações do site
        $settings = SiteSetting::all()->keyBy('key');
        
        // Buscar depoimentos ativos
        $testimonials = \App\Models\Testimonial::where('is_active', true)->get();
        
        // Buscar planos ativos
        $plans = \App\Models\Plan::where('is_active', true)->get();
        
        // Buscar FAQs ativas
        $faqs = \App\Models\Faq::where('is_active', true)->get();

        // Estruturar o conteúdo do site
        $content = [
            // Configurações gerais
            'site_name' => $settings->get('site_name')?->value ?? 'Trust-me',
            'site_slogan' => $settings->get('site_slogan')?->value ?? 'Plataforma de Certificação Digital',
            'site_description' => $settings->get('site_description')?->value ?? 'Plataforma de certificação digital e contratos seguros',
            
            // Hero Section
            'home.hero_title' => $settings->get('home.hero_title')?->value ?? 'Certificação Digital e Contratos Seguros',
            'home.hero_subtitle' => $settings->get('home.hero_subtitle')?->value ?? 'Aumente a confiança dos seus clientes com nossos selos digitais e contratos seguros',
            'home.cta_primary_label' => $settings->get('home.cta_primary_label')?->value ?? 'Começar Agora',
            'home.cta_secondary_label' => $settings->get('home.cta_secondary_label')?->value ?? 'Ver Planos',
            
            // Features Section
            'home.features' => [
                [
                    'title' => 'Certificação Digital',
                    'text' => 'Selo de confiança para aumentar a credibilidade da sua empresa'
                ],
                [
                    'title' => 'Contratos Seguros',
                    'text' => 'Crie e gerencie contratos digitais com assinatura eletrônica'
                ],
                [
                    'title' => 'Suporte Especializado',
                    'text' => 'Equipe técnica pronta para ajudar em qualquer momento'
                ]
            ],
            
            // Stats Section
            'home.stats' => [
                ['value' => '1000+', 'label' => 'Clientes Atendidos'],
                ['value' => '5000+', 'label' => 'Documentos Certificados'],
                ['value' => '99.9%', 'label' => 'Uptime'],
                ['value' => '24/7', 'label' => 'Suporte']
            ],
            
            // Steps Section
            'home.steps' => [
                [
                    'title' => 'Cadastre-se',
                    'text' => 'Crie sua conta gratuitamente em menos de 2 minutos'
                ],
                [
                    'title' => 'Escolha seu Plano',
                    'text' => 'Selecione o plano que melhor atende suas necessidades'
                ],
                [
                    'title' => 'Comece a Usar',
                    'text' => 'Acesse todas as funcionalidades imediatamente'
                ]
            ],
            
            // CTA Section
            'home.cta_block_title' => $settings->get('home.cta_block_title')?->value ?? 'Pronto para Começar?',
            'home.cta_block_subtitle' => $settings->get('home.cta_block_subtitle')?->value ?? 'Junte-se a milhares de empresas que já confiam no Trust-me',
            
            // Dados dinâmicos
            'testimonials' => $testimonials,
            'plans' => $plans,
            'faqs' => $faqs,
            
            // Informações de contato
            'contact_email' => $settings->get('contact_email')?->value ?? 'contato@trustme.com',
            'contact_phone' => $settings->get('contact_phone')?->value ?? '(11) 99999-9999',
            'contact_address' => $settings->get('contact_address')?->value ?? 'Rua das Empresas, 123 - São Paulo, SP'
        ];

        return response()->json([
            'success' => true,
            'data' => $content
        ]);
    }
}
