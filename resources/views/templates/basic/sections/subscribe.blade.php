@php
$subscribeContent = getContent('subscribe.content', true);
@endphp

@push('script')
    <script type="text/javascript">
        $('.subscribe-form').on('submit', function(e) {
            e.preventDefault();
            let url = `{{ route('subscribe') }}`;

            let data = {
                email: $(this).find('input[name=email]').val()
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                }
            });
            $.post(url, data, function(response) {
                if (response.errors) {
                    for (var i = 0; i < response.errors.length; i++) {
                        iziToast.error({
                            message: response.errors[i],
                            position: "topRight"
                        });
                    }
                } else {
                    $('.subscribe-form').trigger("reset");
                    iziToast.success({
                        message: response.success,
                        position: "topRight"
                    });
                }
            });
            this.reset();
        })
    </script>
@endpush
