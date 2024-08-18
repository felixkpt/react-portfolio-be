<div class="custom-container">
    <div class="resume-header">
        <table class="resume-table" style="padding: 0!important">
            <tbody>
                <tr>
                    <td style="width: 25%;">
                        <div class="image-container">
                            <img src="{{ $about->image }}" alt="">
                        </div>
                    </td>
                    <td style="width: 75%;padding:12px 12px 0 12px">
                        <table class="resume-table">
                            <tbody>
                                <tr>
                                    <td style="width: 60%;">
                                        <h3 class="name-title">{{ $about->name }}</h3>
                                    </td>
                                    <td style="width: 40%;">
                                        @include('resume-v2.contacts')
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h6 class="slogan">{{ $about->slogan }}</h6>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <table class="resume-table">
        <tbody>
            <tr>
                <td style="width: 70%; padding-inline:16px;vertical-align:top">
                    <div class="table-responsive">
                        <table class="resume-table">
                            <tr>
                                <td>
                                    <h3 class="resume-section-title">Career Summary</h3>
                                    <hr class="section-divider">
                                    {{ $about->introduction }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

</div>
