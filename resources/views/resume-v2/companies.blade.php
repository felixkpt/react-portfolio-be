<div class="mt-3 mb-1">
    @if (!isset($part) || $part != 2)
        <h3 class="resume-section-title">Experience</h3>
        <hr>
    @endif

    <table class="resume-table">
        @php
            $firstPortion = $companies->take(2);
            $secondPortion = $companies->skip(2);
        @endphp

        @if (!isset($part) || $part != 2)
            @foreach ($firstPortion as $company)
                @include('resume-v2.company-experience', ['company' => $company])
            @endforeach
        @else
            @foreach ($secondPortion as $company)
                @include('resume-v2.company-experience', ['company' => $company])
            @endforeach
        @endif
    </table>
</div>
