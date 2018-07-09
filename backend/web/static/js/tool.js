/*
 * @Author: ylq 
 * @Date: 2017-12-27 15:24:58 
 * @Desc: Tool  工具函数集合 
 * @Last Modified by: ylq
 * @Last Modified time: 2017-12-27 15:28:57
 */
ND.Tool = {
    //获取url中的参数
    getUrlParam: function(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return decodeURI(r[2]); return null; //返回参数值
    },

    upLoader: function(id,trueOrFalse,imgSrc,btnId) {
        var $ = jQuery,
        $wrap = $('.pro-loader'),
        // 图片容器
        $queue = $('<ul class="filelist"></ul>')
            .appendTo( $wrap.find('.queueList') ),
        // 状态栏，包括进度和控制按钮
        $statusBar = $wrap.find('.statusBar'),
        // 文件总体选择信息。
        $info = $statusBar.find('.info'),
        // 上传按钮
        $upload = $wrap.find('.uploadBtn'),
        // 没选择文件之前的内容。
        $placeHolder = $wrap.find('.placeholder'),
        // 添加的文件数量
        fileCount = 0,
        // 添加的文件总大小
        fileSize = 0,
        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 1,
        // 缩略图大小
        thumbnailWidth = 110 * ratio,
        thumbnailHeight = 110 * ratio,
        // 可能有pedding, ready, uploading, confirm, done.
        state = 'pedding',

        supportTransition = (function(){
            var s = document.createElement('p').style,
                r = 'transition' in s ||
                    'WebkitTransition' in s ||
                    'MozTransition' in s ||
                    'msTransition' in s ||
                    'OTransition' in s;
            s = null;
            return r;
        })(),

    // WebUploader实例
        uploader;
        if ( !WebUploader.Uploader.support() ) {
            layer.msg('Web Uploader 不支持您的浏览器！如果你使用的是IE浏览器，请尝试升级 flash 播放器', {
                icon: 2,
                time: 3000
            });
            throw new Error( 'WebUploader does not support the browser you are using.' );
        }
        // 实例化
        uploader = WebUploader.create({
            pick: {
                id: id,
                label: '点击选择图片',
                multiple: trueOrFalse
            },
            accept: {
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData: {
                _csrf: $('meta[name="csrf-token"]').attr("content")
            },
            swf: '/plugins/webuploader/Uploader.swf',

            disableGlobalDnd: true,

            chunked: true,
            server: '/upload/index',
            fileNumLimit: 300,
            fileSizeLimit: 5 * 1024 * 1024,    // 200 M
            fileSingleSizeLimit: 1 * 1024 * 1024    // 50 M
        });

        if(trueOrFalse) {
            // 添加“添加文件”的按钮，
            uploader.addButton({
                id: btnId,
                label: '继续添加'
            });
        }

        // 当有文件添加进来时执行，负责view的创建
        function addFile( file ) {
            var $li = $( '<li id="' + file.id + '">' +
                '<p class="imgWrap"></p>'+
                '</li>' ),

            $btns = $('<div class="file-panel">' +
                '<span class="cancel">删除</span>' +
                '</div>').appendTo( $li ),
            $wrap = $li.find( 'p.imgWrap' ),
            $info = $('<p class="error"></p>'),

            showError = function( code ) {
                switch( code ) {
                    case 'exceed_size':
                        text = '文件大小超出';
                        break;

                    case 'interrupt':
                        text = '上传暂停';
                        break;

                    default:
                        text = '上传失败，请重试';
                        break;
                }

                $info.text( text ).appendTo( $li );
            };

            if ( file.getStatus() === 'invalid' ) {
                showError( file.statusText );
            } else {
                // @todo lazyload
                // $wrap.text( '预览中' );
                uploader.makeThumb( file, function( error, src ) {
                    if ( error ) {
                        $wrap.text( '不能预览' );
                        return;
                    }
                    var img = $('<img src="'+src+'">');
                    $wrap.empty().append( img );
                }, thumbnailWidth, thumbnailHeight );
                file.rotation = 0;
        }

        file.on('statuschange', function( cur, prev ) {
                if ( prev === 'queued' ) {
                    $li.off( 'mouseenter mouseleave' );
                    $btns.remove();
                }

                // 成功
                if ( cur === 'error' || cur === 'invalid' ) {
                    showError( file.statusText );
                } else if ( cur === 'interrupt' ) {
                    showError( 'interrupt' );
                } else if ( cur === 'queued' ) {
                } else if ( cur === 'complete' ) {
                    $li.append( '<span class="success"></span>' );
                }

                $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
            });

            $li.on( 'mouseenter', function() {
                $btns.stop().animate({height: 30});
            });

            $li.on( 'mouseleave', function() {
                $btns.stop().animate({height: 0});
            });

            $btns.on( 'click', 'span', function() {
                var index = $(this).index(),
                    deg;
                switch ( index ) {
                    case 0:
                        uploader.removeFile( file );
                        return;
                }
            });

            $li.appendTo( $queue );
            }

        // 负责view的销毁
        function removeFile( file ) {
            var $li = $('#'+file.id);
            $li.off().find('.file-panel').off().end().remove();
        }
        function updateStatus() {
            var text = '', stats;

            if ( state === 'ready' ) {
                text = '选中' + fileCount + '张图片，共' +
                        WebUploader.formatSize( fileSize ) + '。';
            } else if ( state === 'confirm' ) {
                stats = uploader.getStats();
                if ( stats.uploadFailNum ) {
                    text = '已成功上传' + stats.successNum+ '张照片至XX相册，'+
                        stats.uploadFailNum + '张照片上传失败，<a class="retry" href="#">重新上传</a>失败图片或<a class="ignore" href="#">忽略</a>'
                }

            } else {
                stats = uploader.getStats();
                text = '共' + fileCount + '张（' +
                        WebUploader.formatSize( fileSize )  +
                        '），已上传' + stats.successNum + '张';

                if ( stats.uploadFailNum ) {
                    text += '，失败' + stats.uploadFailNum + '张';
                }
            }

            $info.html( text );
        }
    
        function setState( val ) {
            var file, stats;
            if ( val === state ) {
                return;
            }
            $upload.removeClass( 'state-' + state );
            $upload.addClass( 'state-' + val );
            state = val;
            var ifFlag = true;
                uploader.on("uploadAccept", function( file, data){
                    if(imgSrc && imgSrc.length) {
                        for(var i =0;i <imgSrc.length; i++) {
                            if(data.url != imgSrc[i]) {
                                imgSrc.push(data.url)
                            }
                        }
                    }else {
                        imgSrc.push(data.url)
                    }    
                });
                var result = [],
                    len = imgSrc.length;
                for(i = 0; i < len; i++){
                    for(j = i + 1; j < len; j++){
                    if(imgSrc[i] === imgSrc[j]){
                            j = ++i;
                        }
                    }
                    result.push(imgSrc[i]);
                }   
                if(result && result.length) {
                    for(var j = 0;j < result.length; j++) {
                        $(".imgWrap img").each(function(i) {
                            $(this).attr('src',result[i])
                        })
                    }
                }
            switch ( state ) {
                case 'pedding':
                    $placeHolder.removeClass( 'element-invisible' );
                    $queue.parent().removeClass('filled');
                    $queue.hide();
                    $statusBar.addClass( 'element-invisible' );
                    uploader.refresh();
                    break;

                case 'ready':
                    $placeHolder.addClass( 'element-invisible' );
                    if(trueOrFalse){
                        $(btnId).removeClass( 'element-invisible');
                    }
                    $queue.parent().addClass('filled');
                    $queue.show();
                    $statusBar.removeClass('element-invisible');
                    uploader.refresh();
                    break;

                case 'uploading':
                    if(trueOrFalse){
                        $(btnId).addClass( 'element-invisible' );
                    }
                    $upload.text( '暂停上传' );
                    break;

                case 'paused':
                    $upload.text( '继续上传' );
                    break;

                case 'confirm':
                    $upload.text( '开始上传' ).addClass( 'disabled' );
                    stats = uploader.getStats();
                    if ( stats.successNum && !stats.uploadFailNum ) {
                        setState( 'finish' );
                        return;
                    }
                    break;
                case 'finish':
                    stats = uploader.getStats();
                    if ( stats.successNum ) {
                        layer.msg("上传成功", {
                            icon: 1,
                            time: 3000
                        });
                    } else {
                        // 没有成功的图片，重设
                        state = 'done';
                        location.reload();
                    }
                    break;
            }
         updateStatus();
        }

        uploader.onUploadProgress = function( file, percentage ) {
            var $li = $('#'+file.id);
        };

        uploader.onFileQueued = function( file ) {
            fileCount++;
            fileSize += file.size;
            if ( fileCount === 1 ) {
                $placeHolder.addClass( 'element-invisible' );
                $statusBar.show();
            }
            addFile( file );
            setState( 'ready' );
        };
        uploader.onFileDequeued = function( file ) {
            fileCount--;
            fileSize -= file.size;

            if ( !fileCount ) {
                setState( 'pedding' );
            }

            removeFile( file );

        };

        uploader.on( 'all', function( type ) {
            var stats;
            switch( type ) {
                case 'uploadFinished':
                    setState( 'confirm' );
                    break;

                case 'startUpload':
                    setState( 'uploading' );
                    break;

                case 'stopUpload':
                    setState( 'paused' );
                    break;
            }
        });

        uploader.onError = function( code ) {
            layer.msg("请不要上传重复的图片", {
                icon: 2,
                time: 3000
            });
        };

        $upload.on('click', function() {
            if ( $(this).hasClass( 'disabled' ) ) {
                return false;
            }

            if ( state === 'ready' ) {
                uploader.upload();
            } else if ( state === 'paused' ) {
                uploader.upload();
            } else if ( state === 'uploading' ) {
                uploader.stop();
            }
        });

        $info.on( 'click', '.retry', function() {
            uploader.retry();
        });

        $info.on( 'click', '.ignore', function() {
            alert( 'todo' );
        });

        $upload.addClass( 'state-' + state );
    }
            
            
}
