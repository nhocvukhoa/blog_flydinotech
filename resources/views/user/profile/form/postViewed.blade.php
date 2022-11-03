@extends('user.profile.index')
@section('user-profile-content')
<div class="list-post">
    <div class="title">
        <p>Danh sách đã xem gần đây</p>
        <a href="#" class="see-more" title="Xem tất cả">
            Xem tất cả
            <img src="{{ asset('images/arrow.svg') }}" class="arrow">
        </a>
    </div>
    <div class="list-post-content">
        <h4 class="text-center">Không có dữ liệu</h4>
    </div>
</div>
@endsection
