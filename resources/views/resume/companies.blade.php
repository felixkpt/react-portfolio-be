<div class="mb-1">
    <h5 class="text-primary">Experience</h5>
    <table class="table table-borderless table-sm m-0">
        @foreach ($companies as $company)
            <tr>
                <td class="pb-2">
                    <table class="table table-borderless table-sm m-0">
                        <tr>
                            <td class="pt-0"><strong><a class="link-unstyled"
                                        href="{{ URL::to($company->website) }}">{{ $company->name }}</a></strong>
                                <small style="font-weight: bolder;margin:auto;font-size:22px;line-height:0">.</small>
                                <span>{{ $company->position }}</span>
                                <small
                                    class="text-black-50">{{ \Carbon\Carbon::parse($company->start_date)->format('M Y') }}
                                    —
                                    {{ $company->end_date ? \Carbon\Carbon::parse($company->end_date)->format('M Y') : 'Present' }}
                                </small>
                            </td>
                        </tr>
                        <tr>
                            <td class="pt-0">
                                {!! str()->beforeLast(str()->limit($company->roles, 950, '__'), '.') . '.' !!}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        @endforeach
    </table>
</div>