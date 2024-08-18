{{-- company-experience.blade.php --}}

<tr>
    <td class="pb-2">
        <table class="resume-table">
            <tr>
                <td class="pt-0">
                    <strong>
                        <a class="resume-sub-title" href="{{ URL::to($company->website) }}">
                            {{ $company->name }}
                        </a>
                    </strong>
                    <small style="font-weight: bolder; margin:auto; font-size:22px; line-height:0">.</small>
                    <span>{{ $company->position }}</span>
                    <small class="text-black-50">
                        {{ \Carbon\Carbon::parse($company->start_date)->format('M Y') }} —
                        {{ $company->end_date ? \Carbon\Carbon::parse($company->end_date)->format('M Y') : 'Present' }}
                    </small>
                </td>
            </tr>
            <tr>
                <td class="pt-0">
                    {!! str()->beforeLast(str()->limit($company->roles, 950, '__'), '.') . '.' !!}
                </td>
            </tr>
            @if ($company->achievements)
                <tr>
                    <td class="pt-0">
                        <h6 class="resume-sub-title-sm">Achievements:</h6>
                        {!! $company->achievements !!}
                    </td>
                </tr>
            @endif
            @if ($company->skills->count() > 0)
                <tr>
                    <td class="pt-0">
                        <h6 class="resume-sub-title-sm">Technologies used:</h6>
                        <div class="d-flex flex-wrap">
                            @foreach ($company->skills as $skill)
                                <div class="companies-card cursor-default">
                                    {{ $skill->name }}
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endif
        </table>
    </td>
</tr>
