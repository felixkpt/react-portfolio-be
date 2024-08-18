<div class="mt-3 mb-1">
        <h3 class="resume-section-title">Skills</h3>
        <hr>
    <table class="resume-table">
        <tr>
            <td class="pb-2">
                <div class="row">
                    @php
                        // Split the skills categories based on the part
                        $skillsToDisplay =
                            isset($part) && $part == 2
                                ? $skills_categories->skip(2) // Skip the first 2 categories for part 2
                                : $skills_categories->take(2); // Take the first 2 categories for part 1
                    @endphp

                    @foreach ($skillsToDisplay as $skills_category)
                        <div class="col-6 col-md-12 mb-3">
                            <table class="resume-table">
                                <tr>
                                    <td class="py-0">
                                        <strong class="resume-sub-title-sm">{{ $skills_category->name }}</strong>
                                        @include('resume-v2.skills', [
                                            'skills_category' => $skills_category,
                                        ])
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                </div>
            </td>
        </tr>
    </table>
</div>
