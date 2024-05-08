<div class="mb-4">
    <table class="table table-borderless table-sm m-0">
        <tr>
            @if ($about->image)
                <td class="px-2 mb-3">
                    <div style="width:4.3rem;height: 4.3rem;border-radius:50%">
                        <img src="{{ url('assets/' . $about->image) }}" alt=""
                            style="width:4rem;height: 4rem;border-radius:50%">
                    </div>
                </td>
            @endif
            <td class="col-11 p-0" style="vertical-align: middle">
                <h3 class="text-primary my-0">{{ $about->name }}</h3>
            </td>
        </tr>
    </table>
    <h6> <small>{{ $about->slogan }}</small> </h6>
    <hr class="border">
</div>
