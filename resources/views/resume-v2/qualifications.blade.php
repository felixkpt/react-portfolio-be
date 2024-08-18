<div class="mt-3 mb-1">
    <h3 class="resume-section-title">Education</h3>
    <hr>
    <table class="resume-table">
        @foreach ($qualifications as $qualification)
            <tr>
                <td class="pb-2">
                    <table class="resume-table">
                        <tr>
                            <td class="pt-0">
                                <div><strong><a href="#!" class="resume-sub-title-sm">{{ $qualification->course }}</a></strong></div>
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
