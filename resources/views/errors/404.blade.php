@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 m-x-auto pull-xs-none vamiddle">
            <div class="clearfix">
                <h1 class="pull-left display-3 m-r-2">404</h1>
                <h4 class="p-t-1">هل وصلت بالخطأ</h4>
                <p class="text-muted">الصفحة المطلوبة غير موجودة !!!</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function verticalAlignMiddle()
    {
        var bodyHeight = $(window).height();
        var formHeight = $('.vamiddle').height();
        var marginTop = (bodyHeight / 2) - (formHeight / 2);
        if (marginTop > 0)
        {
            $('.vamiddle').css('margin-top', marginTop);
        }
    }
    $(document).ready(function()
    {
        verticalAlignMiddle();
    });
    $(window).bind('resize', verticalAlignMiddle);
</script>
@endpush
