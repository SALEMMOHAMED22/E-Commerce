import "./bootstrap";

if (layout == "admin") {
    var channel = window.Echo.private("admins." + adminId).notification(
        (event) => {
            let url =
                showOrderRoute.replace(":id", event.order_id) +
                "?notify_admin=" +
                event.id;

            $("#pushRealTime").prepend(` <a
                                            href="${url}">
                                            <div class="media">
                                                <div class="media-left align-self-center"><i
                                                        class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">${event.message}
                                                    </h6>
                                                    <p class="notification-text font-small-3 text-muted">
                                                        Order From : ${event.user_name} ,
                                                        EGP ${event.total_price}
                                                    </p>
                                                    <small>
                                                        <time class="media-meta text-muted"
                                                            datetime="${event.created_at}">${event.created_at}</time>
                                                    </small>
                                                </div>
                                            </div>
                                        </a>`);

        count = Number($('#notification_count').text()) ;
        $('#notification_count').text(count + 1);

        count = Number($('#notification_count_inside').text()) ;
        $('#notification_count_inside').text(count + 1);




            
        });
}
