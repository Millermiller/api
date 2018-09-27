<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>

    </title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <style type="text/css">
        .container {
            display: flex;
            height: 100%;
        }

        .login-widget {
            margin: auto;
        }

        .input, .textarea {
            -moz-appearance: none;
            -webkit-appearance: none;
            -ms-flex-align: center;
            align-items: center;
            border: none;
            border-radius: 3px;
            box-shadow: none;
            display: -ms-inline-flexbox;
            display: inline-flex;
            font-size: 1rem;
            height: 2.285em;
            -ms-flex-pack: start;
            justify-content: flex-start;
            line-height: 1.5;
            padding-left: .75em;
            padding-right: .75em;
            position: relative;
            vertical-align: top;
            background-color: #fff;
            border: 1px solid #dbdbdb;
            color: #363636;
            box-shadow: inset 0 1px 2px hsla(0, 0%, 4%, .1);
            max-width: 100%;
            width: 100%;
        }

        .input:hover {
            border-color: #b5b5b5;
        }

        .input:active, .input:focus {
            border-color: #00d1b2;
            outline: none;
        }

        .login-widget {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 3px hsla(0, 0%, 4%, .1), 0 0 0 1px hsla(0, 0%, 4%, .1);
            display: block;
            padding: 1.25rem;
        }

        .input.is-danger, .textarea.is-danger {
            border-color: #ff3860;
        }

        .control:not(:last-child) {
            margin-bottom: .75rem;
        }

        .control {
            position: relative;
            text-align: left;
        }
        .control .button[data-v-6f9e058f] {
            margin: inherit;
        }
        .button[data-v-6f9e058f] {
            margin: 5px 0 0;
        }
        .button.is-success {
            background-color: #23d160;
            border-color: transparent;
            color: #fff;
        }
        .button {
            -moz-appearance: none;
            -webkit-appearance: none;
            -ms-flex-align: center;
            align-items: center;
            border: none;
            border-radius: 3px;
            box-shadow: none;
            display: -ms-inline-flexbox;
            display: inline-flex;
            font-size: 1rem;
            height: 2.285em;
            -ms-flex-pack: start;
            justify-content: flex-start;
            line-height: 1.5;
            position: relative;
            vertical-align: top;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: #fff;
            border: 1px solid #dbdbdb;
            border-top-color: rgb(219, 219, 219);
            border-right-color: rgb(219, 219, 219);
            border-bottom-color: rgb(219, 219, 219);
            border-left-color: rgb(219, 219, 219);
            color: #363636;
            cursor: pointer;
            -ms-flex-pack: center;
            justify-content: center;
            padding-left: .75em;
            padding-right: .75em;
            text-align: center;
            white-space: nowrap;
        }
        body, button, input, select, textarea {
            font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen,Ubuntu,Cantarell,Fira Sans,Droid Sans,Helvetica Neue,Helvetica,Arial,sans-serif;
        }
    </style>

</head>

<body>
<div class="container">
    <div class="login-widget">
        <p>scandinaver</p>
        <form action="/admin/login" method="post">
            {!! csrf_field() !!}
            <p class="control">
                <input
                        type="text"
                        name="login"
                        class="input {{ $errors->has('login') ? ' is-danger' : '' }}"
                        placeholder="login"
                        required
                >

            </p>
            @if ($errors->has('login'))
                <span class="help-block">
                        <strong>{{ $errors->first('login') }}</strong>
                </span>
            @endif
            <p class="control">
                <input
                        type="password"
                        name="password"
                        class="input {{ $errors->has('password') ? ' is-danger' : '' }}"
                        placeholder="password"
                        required>
                @if ($errors->has('password'))
                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                @endif
            </p>
            <p class="control">
                <button class="button is-success" type="submit">Войти</button>
            </p>
        </form>
    </div>
</div>
</body>

</html>