<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Card</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;

    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>

	<h1 style="text-align: center">Course Outline for {{$course->title}}</h1>

        @foreach ($sections as $section)
            <h3>{{$section->title}}</h3>
            <ol type="a">
                @foreach ($section->lectures as $lecture)
                        <li>{{$lecture->title}}
                            @if ($lecture->hasVideo())
                                <div class="column is-narrow">
                                    <i class="mdi mdi-film"></i>
                                </div>
                            @endif
                        </li>
                @endforeach
            </ol>
        @endforeach

</body>
</html>
