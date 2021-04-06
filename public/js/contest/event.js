var Contest = function() {
	this.__construct = function() {
		this.gameType();
        // this.contestTournament();
        this.calMaxUser();
        this.addRow();
        this.adminPercent();
        this.chooseCommType(); 
        this.breakdownCal();
        this.removeRow();
        this.search();
        this.cloneContest();
        this.cloneModal();
        this.getCustomContest();
        this.private();
        this.isFreeContest(); 
         this.choosePrizeDistribution(); 
	};

    this.search = function() {
        $(document).on('click','.search-btn',function(evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            var keyword = $('#keyword').val();
            var type = $("#type").val();
            var e = $(this);

            $.get(url,{keyword:keyword,type:type},function(out) {
                if(e.hasClass('custom-btn')) {
                    $("#custom-wrapper").html(out);
                } else {
                    $("#list-wrapper").html(out);
                }
            }); 
        });
    };

	this.gameType = function() {
		$(document).on('click','#traditional,#weekend,#survive',function() {
			var radioValue = $("input[name='game_type']:checked").val();
            if(radioValue == 'traditional' || radioValue == 'weekend'){
                $(".normal-entry").removeClass('d-none');
                $("#survive-entry").addClass('d-none');
            }
            if(radioValue == 'survive'){
                $("#survive-entry").removeClass('d-none');
                $(".normal-entry").addClass('d-none');   
            }
		});
	};

    this.private = function() {
        $(document).on('click','#is_private',function() {
            var radioValue = $("input[name='is_private']:checked").val();
            if(radioValue == '1'){
                $("#private_password").removeClass('d-none');
            }else{
                $("#private_password").addClass('d-none');
            }
        });
    };

    // this.contestTournament = function() {
    //     $(document).on('click','#single,#re-occurring',function() {
    //         var radioValue = $("input[name='contest_type']:checked").val();
    //         if(radioValue == 'single') {
    //             $("#single-tournament").removeClass('d-none');
    //             $("#multi-check").removeClass('d-none');
    //         }
    //         if(radioValue == 're-occurring') {
    //             $("#single-tournament").addClass('d-none');
    //             $("#multi-check").addClass('d-none');
    //         }
    //     });
    // };

    this.calMaxUser = function() {
        $(document).on('change','#max_entry,#survive_max_entry',function(evt) {
            evt.preventDefault();
            var max_entry = $(this).val();
            // var from_html = '<option value="">-</option>';
            // var to_html = '<option value="">-</option>';
            // for(var i = 1;i <= max_entry;i++) {
            //     from_html += '<option value="'+i+'">'+i+'</option>'
            //     to_html += '<option value="'+i+'">'+i+'</option>'
            // }
            // $('.from').html(from_html);
            // $('.to').html(to_html);
            $('.from').html('');
            $('.to').html('');            
            $('.percent').val('');
            $('.amount').val('');
            $('.person').val('');
        }); 
    };

    this.addRow = function() {
        $(document).on('click','.add-breakdown',function(evt) {
            evt.preventDefault();
            $('#pool_breakdown').append('<div class="row breakdown-row">'+$('#breakdown-row').html()+'</div>');


            var radioValue = $("input[name='prize_type']:checked").val();
            // alert(radioValue); 
            if(radioValue == 'per'){
                $('#pool_breakdown .percent').each(function() {
                    $(this).closest('.col-md-2').show(); 
                });
                $('#pool_breakdown .amount').each(function() {
                    $(this).prop('readonly', true);
                });
            }else{
                $('#pool_breakdown .percent').each(function() {
                    $(this).closest('.col-md-2').hide(); 
                });
                $('#pool_breakdown .amount').each(function() {
                    $(this).prop('readonly', false);
                });                
            }


        });
    };

    this.removeRow = function() {
        $(document).on('click','.remove-breakdown',function(evt) {
            evt.preventDefault();
            $(this).parents('.breakdown-row').remove();
        });
    };

    this.chooseCommType = function() {
        $(document).on('change','.choose-comm-type',function(evt) {
            var radioValue = $("input[name='amt_type']:checked").val();
            if(radioValue == 'per'){
                $("#admin_per").closest('.col-md-4').show();
                $("#admin_fix").closest('.col-md-4').hide();
                $("#admin_fix").val('');
            }else{
                 $("#admin_fix").closest('.col-md-4').show();
                 $("#admin_per").closest('.col-md-4').hide();
                 $("#admin_per").val(''); 
            }

        }); 
    }; 

    this.choosePrizeDistribution = function() {
        $(document).on('change','.choose-prize-distribution',function(evt) {
            var radioValue = $("input[name='prize_type']:checked").val();
            if(radioValue == 'per'){

                $(".percent").closest('.col-md-2').show();
                $(".amount").prop('readonly', true);
                $(".percent_header").show();
            }else{
                $(".percent").closest('.col-md-2').hide();
                $(".amount").prop('readonly', false);
                $(".percent_header").hide();
            }
        }); 
    }; 


    this.isFreeContest = function() {
        $('#is_free').change(function() {
            if($(this).is(":checked")) {
                // alert('checked'); 
                $('input[name ="amt_type"], input[name="admin_per"], input[name="admin_fix"], input[name="admin_amt"], input[name="entry_fee"], input[name="prize_type"]').attr('disabled',true);
                $('#pool_breakdown *').filter(':input').each(function(){
                   $(this).attr('disabled', true);
                });
    // #pool_breakdown

            }else{
               $('input[name ="amt_type"], input[name="admin_per"], input[name="admin_fix"], input[name="admin_amt"], input[name="entry_fee"], input[name="prize_type"]').attr('disabled',false);
                $('#pool_breakdown *').filter(':input').each(function(){
                   $(this).attr('disabled', false);
                });

                 $('#max_entry').trigger('change');
            }
        });
    }; 

    this.adminPercent = function() {
        $(document).on('change','#admin_per,#admin_fix,#entry_fee,#max_entry,#survive_max_entry',function(evt) {
            evt.preventDefault();
            var admin_per = $("#admin_per").val();
            var admin_fix = $("#admin_fix").val();
            var entry_fee = $("#entry_fee").val();
            var max_entry = "";
            var radioValue = $("input[name='game_type']:checked").val();
            if(radioValue == 'survive') {
                max_entry = $("#survive_max_entry").val();
            } else {
                max_entry = $("#max_entry").val();
            }

            var total_amount = (entry_fee * max_entry);

            var radioValue = $("input[name='amt_type']:checked").val();

            if(radioValue == 'per'){
                var admin_amt = (total_amount * (admin_per/100));
                var winning_amt = total_amount - admin_amt;
            }else{
                var admin_amt = (total_amount - admin_fix);
                var winning_amt = total_amount - admin_fix;
                $("#admin_per").val(0); // as it is required on admin end 
            }

            // alert(admin_amt);

            // var admin_amt = (total_amount * (admin_per/100));
            // var winning_amt = total_amount - admin_amt;
            $('#admin_amt').val(admin_amt);
            $('#winning_amt').val(winning_amt);
            contest.reviseCal();
        });
    };

    this.reviseCal = function() {
        $('.percent').trigger('change');
    };

    this.breakdownCal = function() {
        $(document).on('change','.percent, .amount',function(evt) {
            evt.preventDefault();
            var winning_amt = $('#winning_amt').val();

            var from = $(this).parents('.breakdown-row').find('.from-col .from').val();
            var to = $(this).parents('.breakdown-row').find('.to-col .to').val();
            var total_person = 0;
            if(to == "" || to == undefined) {
                total_person = 1; 
            } else {
                total_person = parseInt(to) - parseInt(from) + 1;
            }

            var amount = 0; 
            if($(this).hasClass('percent')){
                var percent = $(this).val();
                var amount = (winning_amt * (percent/100));
                var total_amount = amount*total_person;

            $(this).parents('.breakdown-row').find('.amount-col .amount').val((total_amount).toFixed());
            $(this).parents('.breakdown-row').find('.person-col .person').val((total_amount/total_person).toFixed());

            }else if($(this).hasClass('amount')){
                // var percent = $(this).val();
                // var per_person = $(this).val();
                if($(this).val()){
                    var amount = parseFloat($(this).val()); // (total_person * per_person);
                }
                
  // console.log('winning_amt '+ winning_amt); console.log('total_person '+ total_person);  console.log('amount '+ amount);
            $(this).parents('.breakdown-row').find('.amount-col .amount').val(amount.toFixed());
            $(this).parents('.breakdown-row').find('.person-col .person').val((amount/total_person).toFixed());

            }

            // console.log('total_person'+total_person); console.log('per_person'+per_person);  console.log('amount'+amount); 
            var sum = 0;
            // var from = $(this).parents('.breakdown-row').find('.from-col .from').val();
            // var to = $(this).parents('.breakdown-row').find('.to-col .to').val();
            // var total_person = 0;
            // if(to == "" || to == undefined) {
            //     total_person = 1; 
            // } else {
            //     total_person = parseInt(to) - parseInt(from) + 1;
            // }

            $('.amount').each(function() {
                if($(this).val() !== '') {
                    sum += parseFloat($(this).val());
                }
            });
            console.log('amount');
            console.log(sum); 
            // alert(sum); alert(winning_amt); 
            // console.log('sum '+ sum); console.log('winning_amt '+ winning_amt); 
            if(sum > winning_amt) {
                $(this).parents('.breakdown-row').find('.amount-col .amount').val('');
                $(this).parents('.breakdown-row').find('.person-col .person').val('');
                alert('Winning amount exceed');
            } else {
                $("#breakdown_amt").val(sum);   
            }
        });

        $(document).on('change','.person',function(evt) {
            evt.preventDefault();
            var winning_amt = $('#winning_amt').val();
            var person = parseInt($(this).val());
            var sum = 0;
            var from = $(this).parents('.breakdown-row').find('.from-col .from').val();
            var to = $(this).parents('.breakdown-row').find('.to-col .to').val();
            var total_person = 0;
            if(to == "" || to == undefined) {
                total_person = 1; 
            } else {
                total_person = parseInt(to) - parseInt(from) + 1;
            }


            // $('.amount').each(function() {
            //     if($(this).val() !== '') {
            //         sum += parseFloat($(this).val());
            //     }
            // });

            var radioValue = $("input[name='prize_type']:checked").val();
            if(radioValue == 'per'){

                var percent = person/winning_amt * 100;
                var amount = (winning_amt * (percent/100));
                $(this).parents('.breakdown-row').find('.amount-col .amount').val(amount * total_person);
                $(this).parents('.breakdown-row').find('.percent-col .percent').val(percent.toFixed(2));
//                 console.log('per');
// console.log(amount);
            }else{
                // var percent = person/winning_amt * 100;
                // tmp_winning_amt = winning_amt-sum; // get final winning amount 
                // var amount = tmp_winning_amt/person; //  (winning_amt * (percent/100));
                // console.log('fix');
                // console.log(total_person); console.log(person); 
                // console.log(sum); 
                // console.log(amount); 
                // console.log('winning_amt '+ winning_amt); console.log('person '+ person);  console.log('amount '+ amount);
                $(this).parents('.breakdown-row').find('.amount-col .amount').val(person * total_person); // val(amount * total_person);
                // $(this).parents('.breakdown-row').find('.percent-col .percent').val(percent.toFixed(2));
                // $(this).parents('.breakdown-row').find('.percent-col .percent').val(0);

            }


            // var percent = person/winning_amt * 100;
            // var amount = (winning_amt * (percent/100));
            // $(this).parents('.breakdown-row').find('.amount-col .amount').val(amount * total_person);
            // $(this).parents('.breakdown-row').find('.percent-col .percent').val(percent.toFixed(2));

            $('.amount').each(function() {
                if($(this).val() !== '') {
                    sum += parseFloat($(this).val());
                }
            });
            
            // alert(sum); alert(winning_amt); 
            // console.log(sum); 
            // console.log(winning_amt); 
            if(sum > winning_amt) {
                $(this).parents('.breakdown-row').find('.amount-col .amount').val('');
                $(this).parents('.breakdown-row').find('.person-col .person').val('');
                alert('Winning amount exceed');
            } else {
                $("#breakdown_amt").val(sum);
            }
        });

        $(document).on('change','.from,.to',function() {
            // $('.percent').trigger('change');

            var radioValue = $("input[name='prize_type']:checked").val();
            // alert();
            if(radioValue == 'per'){

                 $('.percent').trigger('change');
            }else{
                 $('.amount').trigger('change');
            }


        });
    };

    this.cloneModal = function () {
        $(document).on('click','.clone',function(evt) {
            evt.preventDefault();
            var contest_id = $(this).data('contest-id');
            var action = $(this).attr('href');

            $("#cloneModal").find('.clone-contest').attr('action',action);
            $("#cloneModal").find('#contest_id').val(contest_id);

        });
    };

    this.cloneContest = function() {
        $(document).on('submit','.clone-contest',function(evt) {
            evt.preventDefault();
            var formData = $(this).serialize();
            var url = $(this).attr('action');
            var e = $(this);
            
            $.post(url,formData,function(out) {
                if(out.result == 0) {
                    for(var i in out.errors) {
                        e.find("#"+i).parents('.form-group').append('<span class="text-danger">'+out.errors[i]+'</span>');
                    }
                }
                if(out.result == 1) {
                    window.location.href = out.url;
                }
            });
        });
    };

    this.getCustomContest = function() {
        $(document).on('click','#custom-tab',function() {
            var url = $("#custom-wrapper").data('url');
            $.get(url,function(out) {
                $("#custom-wrapper").html(out);
            }); 

        });
    };

	this.__construct();
};

var contest = new Contest();