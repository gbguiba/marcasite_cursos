<p>
    Olá {{ $name }}! Tudo bem? ✌️
</p>

<p>

    Uma nova conta de

    <strong>
        @if ($type === 'user')
            usuário
        @elseif ($type === 'admin')
            administrador
        @endif
    </strong>
    
    foi criada utilizando
    seu endereço de e-mail
    (<strong>{{ $email }}</strong>).

</p>

<p>
    Sua senha para acesso é: 
    <strong>{{ $password }}</strong>.
</p>

<p>
    Acesse o sistema em
    {{ config('app.url') }}.
</p>

<p>
    Até mais! 👋
</p>

<p>
    {{ config('app.name') }}
</p>
