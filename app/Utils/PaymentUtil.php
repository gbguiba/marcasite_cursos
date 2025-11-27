<?php

namespace App\Utils;

class PaymentUtil {

    private function __construct() {}

    public static function friendlyStatus(string $status): string {
        
        $available = [
            'error' => 'Erro no pagamento',
            'pending' => 'Aguardando pagamento',
            'in_process' => 'Processando pagamento',
            'approved' => 'Pagamento aprovado',
            'rejected' => 'Pagamento recusado',
            'refunded' => 'Pagamento reembolsado ao comprador',
            'charged_back' => 'Pagamento contestado',
            'expired' => 'Pagamento expirado',
            'cancelled' => 'Pagamento cancelado',
        ];
        
        return array_key_exists($status, $available) ? $available[$status] : 'Pagamento indefinido';

    }

    public static function formatTransactionAmount(string $currency, float $transactionAmount): ?string {

        if ($currency === 'BRL') {
            
            return "R$ " . number_format($transactionAmount, 2, ',', '.');
        
        }

        return null;

    }

}
