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

	<h1 style="text-align: center">Lecture Outline for {{$course->title}}</h1>


        <ol type="1">
            @foreach ($linked_courses as $linkedcourse)
              <li><strong>{{$linkedcourse->title}}</strong
                  <p>{{$linkedcourse->sypnosis}}</p>
              </li>
            @endforeach

        </ol>

</body>
</html>
