<h3 style="text-align: center; color: #345797;">Доброго времени {{$user->name}}</h3>
<p>Пожалуйста подтвердите ваш email пройдя по даный ссылке
    {{
        url('http://mynotify.test/validate') . '?' . http_build_query(['id' => $user->id, 'key' => $user->activation_key])
    }}</p>

