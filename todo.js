function call(url, type, data, success_callback) {
    jQuery.ajax({
        type: type, //GET|POST|DELETE|PUT
        url: url,
        data: data,
        dataType: "json",
        success: success_callback,
        error: function() {}
    });
}

function loadRecords() {
    call("/api.php?/todo/list", "GET", "", function(res) {
        if (res.status && res.status === "ok") {
            $('.records').html("");
            for (var i in res.result) {
                var record = res.result[i];
                console.log(i);
                console.log(record);
                var div = $('<div id="rec' + i + '" class="_record""></div>').appendTo(".records");
                $(div).append('<span class="_label">' + record.label + '</span>');
                $(div).append('<span class="_status">' + record.done + '</span>');
                var linkrem = $('<a class="a_rem">Remove</a>').appendTo(div);
                setRemoveAction(linkrem, i);
                if (record.done == 0) {
                    var linkdone = $('<a class="a_done">Done</a>').appendTo(div);
                    setDoneAction(linkdone, i)
                }
            }
        }
    });
}

function setRemoveAction(linkobj, id) {
    $(linkobj).click(function() {
        call("/api.php?/todo/remove", "DELETE", id, function(res) {
            if (res.status && res.status === "ok") {
                $("#rec" + id).remove();
            }
        });
    });
}

function setDoneAction(linkobj, id) {
    $(linkobj).click(function() {
        call("/api.php?/todo/mark-as-don", "POST", id, function(res) {
            if (res.status && res.status === "ok") {
                $("#rec" + id).find('._status').html("1");
                $("#rec" + id).find('.a_done').remove();
            }
        });
    });
}
$('.a_add').click(function() {
    var nr = Math.round((Math.random() * 10));
    call("/api.php?/todo/add", "PUT", "Buy book title" + nr, function(res) {
        if (res.status && res.status === "ok") {
            loadRecords();
        }
    });
})

loadRecords();