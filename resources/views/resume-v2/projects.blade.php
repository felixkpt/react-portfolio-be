<div class="mt-3 mb-1">
    <h3 class="resume-section-title">Projects Summary</h3>
    <hr>
    <table class="table table-borderless table-sm m-0">
        @foreach ($projects as $project)
            <tr>
                <td class="pb-2">
                    <table class="table table-borderless table-sm m-0">
                        <tr>
                            <td class="py-0"><strong><a class="link-unstyled"
                                        href="{{ URL::to($project['project_url']) }}">{{ $project['title'] }}</a></strong>
                                <small style="font-weight: lighter" class="fa fa-circle"></small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! str()->beforeLast(str()->limit($project['description'], 350, '__'), '.') . '.' !!}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        @endforeach
    </table>

</div>
