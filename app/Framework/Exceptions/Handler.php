<?php

declare(strict_types=1);

namespace App\Framework\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Список типов исключений, которые не нужно логировать.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        // Добавьте свои исключения, которые не нужно логировать
    ];

    /**
     * Список полей, которые не будут сохраняться в сессии
     * (например, при валидации) для предотвращения утечки данных.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Регистрация колбэков/функций для обработки или логирования исключений.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            // Можно добавить логику логирования или иные действия с исключениями
        });
    }

    /**
     * Метод для кастомного рендеринга (возвращения) ответа при возникновении исключений.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $e)
    {
        // Если нужно реализовать собственную логику при возвращении ошибок,
        // вы можете сделать это здесь. В противном случае вернём стандартное поведение.
        return parent::render($request, $e);
    }
}
