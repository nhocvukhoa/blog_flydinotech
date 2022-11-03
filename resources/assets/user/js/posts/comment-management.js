$(document).ready(function() {
    fetchPost();

    function fetchPost(postSlug)
    {
        var postSlug = $('#post-id-fetch').val();
        var url = '/post/detail/fetch-post/' + postSlug;

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#list-comment').html('');
                $.each(response.post, function(key, item) {
                    var countComment = item.count_comment;
                    var parentComment = [];

                    $.each(item.comment, function (key, parent) {
                        var countReplies = parent.count_replies;
                        var parentId = parent.id;
                        loadMoreReplyComment(parentId, '');

                        parentComment += `<div class="mb-3 border border-1 rounded px-3 content-comment-container-${parent.id}">
                                            <div class="show-reply-comment py-2">
                                                ${infoUser(parent)}
                                                <div class="d-flex flex-column">
                                                    ${editComment(parent)}
                                                    ${addComment(parent)}
                                                </div>
                                            </div>
                                            <div class="ps-5 pe-0">` +
                                                (countReplies > 2 ?
                                                    `<div class="comment-reply-${parent.id}">
                                                        <div id="load-more-comment-${parent.id}">
                                                        </div>
                                                        <button data-id="${parent.id}" class="more-comments py-2 d-flex flex-row justify-content-center bg-white col-12" value="${countReplies}">
                                                            <i class="fa-solid fa-chevron-down mx-1"></i>
                                                            <span class="text-primary">Xem thêm bình luận</span>
                                                        </button>
                                                    </div>`
                                                :
                                                    `<div id="load-more-comment-${parent.id}">
                                                    </div>`
                                                ) +
                                            `</div>
                                        </div>`;
                    });

                    $('#list-comment').append(
                        (countComment > 0 ?
                            `${parentComment}`
                        :
                            `<div class="card shadow-none py-3">
                                <span class="text-center">Chưa có bình luận nào</span>
                            </div>`
                        )
                    );       
                });
            }
        });
    }

    var authUser = $('#auth-user-id').val();

    function infoUser(item)
    {
        var userId = item.user_id;

        return `<div class="d-flex flex-row mb-1">
                    <div class="p-1">
                        <a href="#">
                            <img class="rounded-circle" src="/storage/images/avatar/${item.user.userProfile.avatar}">
                        </a>
                    </div>
                    <div class="info-comment d-flex ps-2 mb-2">
                        <div class="d-flex flex-column justify-content-center">
                            <b>${item.user.userProfile.full_name}</b>
                            <div class="mt-2 comment-time">
                                <span class="me-1">${item.created_at}</span>
                            </div>
                        </div>` +
                        (authUser == userId ?
                            `<div class="d-flex flex-row ms-auto">
                                <div class="ms-2">
                                    <button value="${item.id}" class="btn btn-light delete-comment">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                                <div id="icon-edit-${item.id}" class="ms-2">
                                    <button value="${item.id}" class="btn btn-light update-comment" id="btn-edit-comment">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </button>
                                </div>
                            </div>`
                        :
                            `<div class="d-flex flex-row ms-auto"></div>`
                        ) +
                    `</div>
                </div>`;
    }

    function editComment(item)
    {
        return `<div class="row px-3">
                    <div id="content-comment-${item.id}">${item.content}</div>
                    <div class="form-edit" id="form-edit-${item.id}">
                        <form id="edit-parent-comment-${item.id}">
                            <textarea name="content" class="form-control content-${item.id}" placeholder="Nhập bình luận ..." rows="3">${item.content}</textarea>
                            <div class="text-right">
                                <div class="close-edit-${item.id} btn btn-secondary">Đóng</div>
                                <input type="submit" class="btn btn-primary my-2" value="Lưu">
                            </div>
                        </form>
                    </div>
                    <div class="d-flex flex-row reply-comment my-1">` +
                        (authUser ?
                            `<div id="icon-reply-${item.id}" class="icon-reply mx-1">
                                <button class="btn btn-light mb-1 text-primary create-reply-comment" value="${item.id}" id="btn-reply-comment">
                                    Trả lời
                                </button>
                            </div>`
                        :
                            `<div class="icon-reply mx-1">
                                <a href="/login" class="btn btn-light mb-1 text-primary" id="btn-reply-comment">
                                    Trả lời
                                </a>
                            </div>`
                        ) +
                        `<span class="mx-1">Chia sẻ</span>
                        <a href="#" class="ms-2">
                            <i class="fa-solid fa-ellipsis"></i>
                        </a>
                    </div>
                </div>`;
    }

    function addComment(item)
    {
        return `<div id="form-reply-${item.id}" class="form-reply">
                    <form id="create-reply-comment-${item.id}">
                        <input type="hidden" name="post_id" value="${item.post_id}">
                        <input type="hidden" name="parent_id" value="${item.id}">
                        <textarea name="content" class="form-control" placeholder="Nhập bình luận ..." rows="3"></textarea>
                        <div class="text-right">
                            <div class="close-add-comment btn btn-secondary">Đóng</div>
                            <input type="submit" class="btn btn-primary my-2" value="Gửi bình luận">
                        </div>
                    </form>
                </div>`;
    }

    function addReplyComment(item, parentId)
    {
        return `<div id="form-reply-${item.id}" class="form-reply">
                    <form id="create-reply-comment-${item.id}">
                        <input type="hidden" name="post_id" value="${item.post_id}">
                        <input type="hidden" name="parent_id" value="${parentId}">
                        <textarea name="content" class="form-control" placeholder="Nhập bình luận ..." rows="3"></textarea>
                        <div class="text-right">
                            <div class="close-add-comment btn btn-secondary">Đóng</div>
                            <input type="submit" class="btn btn-primary my-2" value="Gửi bình luận">
                        </div>
                    </form>
                </div>`;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.add-parent-comment', function (e) {
        e.preventDefault();

        var postId = $('input[name = "post_id"]').val();
        var parentId = $('input[name = "parent_id"]').val();
        var content = $('textarea[name = "content"]').val();
        var _token = $('input[name = "_token"]').val();
        var url = '/post/comment';

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                post_id:postId,
                parent_id:parentId,
                content:content,
                _token:_token
            },
            success: function (res) {
                if (res.status == 400) {
                    $.each(res.error, function(prefix, val) {
                        toastr.error(val);
                    });
                } else {
                    $('.parent-comment-form').find('input:text, textarea').val('');
                    toastr.success(res.message);
                    fetchPost();
                }
            }
        });
    });

    $(document).on('click', '.create-reply-comment', function (e) {
        var id = $(this).val();

        $('#create-reply-comment-' + id).submit(function (e) {
            e.preventDefault();

            var postId = $('input[name = "post_id"]').val();
            var parentId = $('#create-reply-comment-' + id +' input[name="parent_id"]').val();
            var content = $('#create-reply-comment-' + id +' textarea[name="content"]').val();
            var url = '/post/comment';

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    post_id:postId,
                    parent_id:parentId,
                    content:content
                },
                success: function (res) {
                    if (res.status == 400) {
                        $.each(res.error, function(prefix, val) {
                            toastr.error(val);
                        });
                    } else {
                        toastr.success(res.message);
                        fetchPost();
                    }
                }
            });
        });
    });

    $(document).on('click', '.update-comment', function (e) {
        var id = $(this).val();

        $('#edit-parent-comment-' + id).submit(function (e) {
            e.preventDefault();
            var url = '/post/comment/update/' + id;
            var content = $('#edit-parent-comment-' + id + ' .content-' + id).val();
            var _token = $('input[name = "_token"]').val();

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    content:content,
                    _token:_token
                },
                success: function (res) {
                    if (res.status == 400) {
                        $.each(res.error, function(prefix, val) {
                            toastr.error(val[0]);
                        });
                    } else {
                        toastr.success(res.message);
                        fetchPost();
                    }
                }
            });
        });
    });

    $(document).on('click', '.delete-comment', function (e) {
        e.preventDefault();
        var id = $(this).val();
        var url = "/post/comment/" + id;

        Swal.fire({
            title: 'Bạn có chắc muốn xoá bình luận này ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    success: function (res) {
                        if (res.status == 200) {
                            toastr.success(res.message);
                            fetchPost();
                        } else {
                            toastr.error(res.message);
                        }
                    }
                });
            }
        })
    });

    function loadMoreReplyComment(commentId, countReplies)
    {
        var url = '/load-more-reply-comment/' + commentId;

        $.ajax({
            url: url,
            method: 'POST',
            data: {countReplies:countReplies},
            success: function (res) {
                $('#load-more-comment-' + commentId).html('');
                $.each(res.replies, function (key, item) {
                    $('#load-more-comment-' + commentId).append(
                        `<div class="border-top content-comment-border-${commentId}">
                            <div class="show-reply-comment py-2">
                                ${infoUser(item)}
                                <div class="d-flex flex-column">
                                    ${editComment(item)}
                                    ${addReplyComment(item, commentId)}
                                </div>
                            </div>
                        </div>`);
                });
            }
        });
    }

    $(document).on('click', '.more-comments', function (e) {
        e.preventDefault();
        
        var parentId = $(this).data('id');
        var countReplies = $(this).val();

        loadMoreReplyComment(parentId, countReplies);
        $(this).remove();
    });
});
