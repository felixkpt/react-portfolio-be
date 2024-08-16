@if (count($contacts) > 0)
    <div class="mb-1">
        <table class="table table-borderless table-sm m-0">
            @foreach ($contacts as $contact)
                <tr>
                    <td class="pt-0">
                        <div class="text-white mb-2">
                            <div class="pb-1">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($contact->image) }}" alt="{{ $contact->name }}" class="contact-icon me-2" style="width: 24px; height: 24px;">
                                    <div>
                                        <a class="contact-link" href="{{ $contact->link }}" target="_blank">{{ $contact->link }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endif
