<?php

return [
        '/' => 'Home@index',
        '/pagamento' => 'Pagamento@index',
        '/pagamento/[0-9]+' => 'Pagamento@index',
        '/pagamento/[0-9]+/name/[a-z]+' => 'Pagamento@show',
        ];
