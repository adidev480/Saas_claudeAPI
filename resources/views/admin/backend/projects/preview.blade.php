<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale 1.0">
    <title>{{ $project->name }} - Preview</title> 
    <head>
    @if ($project->css_content)
        <style>
            {{ $project->css_content }}
        </style>
    @endif
    </head>
    <body>
        @if($project->html_content)
            {!! $project->html_content !!}
        @else
            <h1>No Content Available </h1>   
            <p>
                Please generate content using AI
            </p>

        @endif

            @if ($project->js_content)
                <script>
                    {{ $project->js_content }}
                <script>
            @endif


    </body>

</html>