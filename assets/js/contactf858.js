function Contact(){var e=!1;if("en"==LANG)var a="<span class='error'>Required fields</span>",r="<span class='error'>ひらがなで入力してください。</span>",t="<span class='error'>カタカナで入力してください。</span>",s="<span class='error'>Please enter the zip code correctly.</span>",n="<span class='error'>Please enter the correct phone number.</span>",p="<span class='error'>The form of E-mail is different.</span>",i="<span class='error'>It does not match the E-mail.</span>";else var a="<span class='error'>必須項目です</span>",r="<span class='error'>ひらがなで入力してください。</span>",t="<span class='error'>カタカナで入力してください。</span>",s="<span class='error'>郵便番号を正しく入力して下さい。</span>",n="<span class='error'>電話番号を正しく入力して下さい。</span>",p="<span class='error'>メールアドレスの形式が異なります。</span>",i="<span class='error'>メールアドレスと一致しません。</span>";for(var o="",l="",d=$("#form input,#form select,#form textarea"),c=function(o){"all"==o?($("#form span.error").remove(),$("#form input.error,#form select.error,#form textarea.error").removeClass("error"),l=$(":text,[type=email],[type=tel],select,radio,checkbox,textarea").filter(".required")):(o.parent("dd").find("span.error").remove(),o.removeClass("error"),l=o),l.each(function(){$(this).filter(".required").each(function(){var e=$(this).attr("id");"hiragana"==e?""==$(this).val()?$(this).parent("dd").append(a):$(this).val().match(/^[ぁ-ろわをんー 　\r\n\t]*$/)||$(this).parent("dd").append(r):"katakana"==e?""==$(this).val()?$(this).parent("dd").append(a):$(this).val().match(/^[ァ-ロワヲンー 　\r\n\t]*$/)||$(this).parent("dd").append(t):"zip"==e?""==$(this).val()?$(this).parent("dd").append(a):(!$(this).val().match(/^[0-9\-]+$/)||$(this).val().length<7)&&$(this).parent("dd").append(s):"email"==e?""==$(this).val()?$(this).parent("dd").append(a):$(this).val().match(/.+@.+\..+/g)||$(this).parent("dd").append(p):"emailcheck"==e?""==$(this).val()?$(this).parent("dd").append(a):$(this).val()!=$("input[name="+$(this).attr("name").replace(/^(.+)check$/,"$1")+"]").val()&&$(this).parent("dd").append(i):"tel"==$(this).attr("type")?""==$(this).val()?$(this).parent("dd").append(a):(!$(this).val().match(/^[0-9\-]+$/)||$(this).val().length<10)&&$(this).parent("dd").append(n):""==$(this).val()&&$(this).parent("dd").append(a)}),$("span.error").each(function(){$(this).parent("dd").find("input,select,textarea").addClass("error")})}),e=!$("#form span.error")[0]},h=0;d.length>h;h++)""!=d.eq(h).val()&&d.eq(h).parent().prev().addClass("focus");d.blur(function(){""==$(this).val()&&$(this).parent().removeClass("focus"),o=$(this),c(o)}),d.focus(function(){$(this).parent().addClass("focus")}),$("#form").submit(function(){if(o="all",c(o),!e){var a=$("#form").offset().top;return $("html,body").animate({scrollTop:a},"fast"),!1}}),$("#reset-btn").on("click",function(){$("span.error").remove(),$("#form .error").removeClass("error");var e=$("#form").offset().top;$("html,body").animate({scrollTop:e},"fast",function(){$("#form dd").removeClass("focus"),f()})}),$("input").change(function(){if("text"==$(this).attr("type")&&$(this).attr("id").match(/tel|email|email_confirm/g)){var e=$(this).val(),a=e.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(e){return String.fromCharCode(e.charCodeAt(0)-65248)});$(this).val(a)}});var f=function(){$(".placeholder").remove();var e=[];if("sp"==device.size)for(var a=0;$("#form").find("input,textarea").length>a;a++)""==$("#form").find("input,textarea").eq(a).val()?(e[a]=$("#form").find("input,textarea").eq(a).parents("dl").children("dt").text(),$("#form").find("input,textarea").eq(a).parents("dl").children("dd").append("<span class='placeholder'>"+e[a]+"</span>")):$("#form").find("input,textarea").eq(a).parents("dl").addClass("focus").find(".placeholder").remove()};f(),$w.on("load resize",function(){f()}),$(document).ready(function(){f()});var m=function(){var e=location.href;switch(params=e.split("?"),params[1]){case"recruit":$("select[name=contacttype]").find("option").eq(3).prop("selected",!0)}};m()}