var Common = function() {
	this.__construct = function() {
		this.add();
		this.search();
		this.update();
		this.status();
		this.delete();
		this.edit();
		this.pagination();
		this.loadItems();
		this.searchList();
		this.getList();
		this.selectAll();
		this.openModal();
		this.vip();
		this.exp();
	};

	this.loadItems = function() {
		$(document).ready(function() {
			var url = $("#list-wrapper").data('url');

			$.get(url,'',function(out) {
				$("#list-wrapper").html(out);
			});
		});
	};
	this.searchList = function() {
	    $(document).on('click','.search-btn',function(evt) {
	        evt.preventDefault();
	        var url = $(this).attr('href');
	        var keyword = $('#keyword').val();
	        var e = $(this);

	        $.get(url,{keyword:keyword},function(out) {
	        	if(e.hasClass('custom-btn')) {
	        		$("#custom-tab").addClass('active show');
	        		$("#contest-tab").removeClass('active show');
	        		$("#profile").addClass('active show');
	        		$("#home").removeClass('active show');
	        		$("#custom-wrapper").html(out);
	        	} else {
	        		$("#custom-tab").removeClass('active show');
	        		$("#contest-tab").addClass('active show');
	        		$("#profile").removeClass('active show');
	        		$("#home").addClass('active show');

	            	$("#list-wrapper").html(out);
	        	}
	        }); 
	    });
	};
	this.add = function() {
		$(document).on('submit','.add-form',function(evt) {
			common.showLoader();
			evt.preventDefault();
			var url = $(this).attr('action');
			var postData = $(this).serialize();
			var form = $(this)[0];
			var e = $(this);
			$.post(url,postData,function(out) {
				common.hideLoader();				
				$("span.text-danger").remove();
				if(out.result == 0) {
					for(var i in out.errors) {
						e.find("#"+i).parents('.form-group').append('<span class="text-danger">'+out.errors[i]+'</span>');
					}
				}
				if(out.result == 1) {
					$("#error_msg").removeClass('d-none').text(out.msg);
					if(!out.edit) {
						form.reset();
					}
					if(out.url) {
						window.location.href = out.url;
					}
				}
				if(out.result == -1) {
					alert(out.msg);
				}
			});
		});
	};

	this.search = function() {
		$(document).on('submit','.search-form',function(evt) {
			common.showLoader();
			evt.preventDefault();
			var url = $(this).attr('action');
			var postData = $(this).serialize();
			var e = $(this);
			$.post(url,postData,function(out) {
				common.hideLoader();
				$('.search-results').html(out);
				$('#list-wrapper').html(out);
			});
		});
	};

	this.update = function() {
		$(document).on('submit','.update-form',function(evt) {
			common.showLoader();
			evt.preventDefault();
			var url = $(this).attr('action');
			var postData = $(this).serialize();
			var form = $(this)[0];
			var e = $(this);
			$.put(url,postData,function(out) {
				common.hideLoader();
				$(".error").remove();
				if(out.result == 0) {
					for(var i in out.errors) {
						$("#"+i).parent('.form-group').append('<span class="error"">'+out.errors[i]+'</span>');
					}
				}
				if(out.result === 1) {
					$("#error_msg").removeClass('d-none').text(out.msg);
				}
			});
		});
	};

	this.status = function() {
		$(document).on('click','.change-status',function(evt) {
			evt.preventDefault();
			common.showLoader();
			var url = $(this).attr('href');
			var status = $(this).data('status');
			var id = $(this).data('id');
			var e  = $(this);	
			$.get(url,{status:status,id:id},function(out) {
				if(out.result == 1) {
					if(status == 1) {
						e.data('status',0);
						e.attr('title','Inactive');
						e.html('<i class="fas fa-thumbs-down"></i>');
						e.parents('tr').find('td.status').html('Active');
					} else {
						e.data('status',1);
						e.attr('title','Active');
						e.html('<i class="fas fa-thumbs-up"></i>');
						e.parents('tr').find('td.status').html('Inactive');
					}
					$("#error_msg").removeClass('d-none').text(out.msg);
					common.hideLoader();
				}
			});
		});
	};

	this.delete = function() {
		$(document).on('click','.delete',function(evt) {
			evt.preventDefault();
			common.showLoader();
			var url = $(this).attr('href');
			var e = $(this);
			if(confirm('Are you sure, you want to Delete?')) {
				$.get(url,'',function(out){
					e.parents('tr.tr-row').remove();
					$("#error_msg").removeClass('d-none').text(out.msg);
					common.hideLoader();
				});
			}
			
		});
	};

	this.edit = function() {
		$(document).on('click','.edit',function(evt) {
			evt.preventDefault();
			var url = $(this).attr('href');

			$.get(url,'',function(out) {
				$(".add-form").attr('action',out.url);
				$(".tile-title span").html('Update');
				$(".add-form").append('<input type="hidden" name="id" value="'+out.items['id']+'">');
				if(out.states) {
					$("#state_id").html(out.states);
				}
				for(i in out.items) {
					$(".add-form").find('#'+i).val(out.items[i]);
				}
			});
		});
	};

	this.pagination = function(){
		$(document).on('click','.page-link',function(evt) {
			evt.preventDefault();
			var url = $(this).attr('href');
			var e = $(this);
			$.get(url,'',function(out) {
				if(e.parents("#custom-list").length) {
					$("#custom-wrapper").html(out);
				} else {
					$("#list-wrapper").html(out);
				}
			});
		});

	};

	this.showLoader = function(){
		$('.loading').show();
	};

	this.hideLoader = function(){
		$('.loading').hide();
	};

	this.getList = function() {
        $(document).on('click','#profile-tab',function() {
            var url = $("#custom-wrapper").data('url');
            $.get(url,function(out) {
                $("#custom-wrapper").html(out);
            }); 

        });
    };

    this.selectAll = function() {
    	$(document).on('change','#select_all',function(evt) {
    		evt.preventDefault();
    		$(".select_checkbox").prop('checked', $(this).prop("checked"));
    	});
    	$(document).on('change','.select_checkbox',function() {
    	    if(false == $(this).prop("checked")){
    	        $("#select_all").prop('checked', false);
    	    }
    		if ($('.select_checkbox:checked').length == $('.select_checkbox').length ){
    			$("#select_all").prop('checked', true);
    		}
    	});
    };

    this.openModal = function() {
    	$(document).on('click','.open-modal',function(evt) {
    		evt.preventDefault();
    		var url = $(this).attr('href');
    		var ids = [];
    		$("input:checkbox[name=user_id]:checked").each(function(){
			    ids.push($(this).val());
			});
    		$.get(url,'',function(out) {
    			$("#extra").html(out);
    			$("#addMoneyModal").modal('show');
    			if(ids != "") {
    				$("#addMoneyModal .add-form").append('<input type="hidden" name="user_id" value="'+ids+'">');
    			}
    		});
    	});
    };

    this.vip = function() {
    	$(document).on('click','#make-vip',function(evt) {
    		evt.preventDefault();
    		var url = $(this).attr('href');
    		var ids = [];
    		$("input:checkbox[class=select_checkbox]:checked").each(function(){
			    ids.push($(this).val());
			});
    		$.get(url,{ids:ids},function(out) {
    			$("#error_msg").removeClass('d-none').text(out.msg);
    			window.location.reload();
    		});
    	});
    };

    this.exp = function() {
    	$(document).on('click','#make-exp',function(evt) {
    		evt.preventDefault();
    		var url = $(this).attr('href');
    		var ids = [];
    		$("input:checkbox[class=select_checkbox]:checked").each(function(){
			    ids.push($(this).val());
			});
    		$.get(url,{ids:ids},function(out) {
    			$("#error_msg").removeClass('d-none').text(out.msg);
    			window.location.reload();
    		});
    	});
    };

	this.__construct();
};

var common = new Common();


