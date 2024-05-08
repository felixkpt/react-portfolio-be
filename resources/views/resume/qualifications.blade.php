<div class="mb-1">
    <h5 class="text-primary">Education</h5>
    <table class="table table-borderless table-sm m-0">
        @foreach ($qualifications as $qualification)
            <tr>
                <td class="pb-2">
                    <table class="table table-borderless table-sm m-0">
                        <tr>
                            <td class="pt-0">
                                <div><strong>{{ $qualification->course }}</strong></div>
                                <div>{{ $qualification->institution }}</div>
                            </td>
                        </tr>
                        <tr>
                        </tr>
                    </table>
                </td>
            </tr>
        @endforeach
    </table>

</div>
