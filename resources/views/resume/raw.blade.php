<style>
    .link-unstyled {

        &,
        &:visited,
        &:hover,
        &:active,
        &:focus,
        &:active:hover {
            font-style: inherit;
            color: inherit;
            background-color: transparent;
            font-size: inherit;
            text-decoration: none;
            font-variant: inherit;
            font-weight: inherit;
            line-height: inherit;
            font-family: inherit;
            border-radius: inherit;
            border: inherit;
            outline: inherit;
            box-shadow: inherit;
            padding: inherit;
            vertical-align: inherit;
        }
    }
</style>
<div class="card m-1">
    <div class="table-responsive">
        <table class="table table-borderless table-sm m-0 px-1">
            <tbody>
                <tr>
                    <td style="width: 70%; padding:0;vertical-align:top">
                        <div class="table-responsive">
                            <table class="table table-borderless table-sm m-0 px-1">
                                <tr>
                                    <td>
                                        @include('resume.about')
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @include('resume.companies')
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </td>
                    <td style="width: 30%; padding:0;">
                        <div class="table-responsive">
                            <table class="table table-borderless table-sm m-0 px-1">
                                <tr>
                                    <td>
                                        @include('resume.contacts')
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @include('resume.skills_categories')
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @include('resume.projects')
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @include('resume.qualifications')
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
