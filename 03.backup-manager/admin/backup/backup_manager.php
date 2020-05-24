<style>
    .backup_wrap {
        position : absolute;
        left : 50%;
        transform : translate(-50%,0);
    }
    
    .fileList {
        margin-top : 20px;
        border : 1px solid #AAAAAA;
    }

    .fileList th, .fileList td {
        padding : 8px 16px 8px 16px;
        border-bottom : 1px solid #AAAAAA;
    }

    .fileList th {
        text-align : center;
    }

    .btn_download {
        padding : 4px 8px 4px 8px;
    }

    .new_backup_wrap {
        margin-top : 20px;
        text-align:center;
    }
    .new_backup_wrap button{
        padding : 4px 8px 4px 8px;
    }
    .new_backup_wrap input{
        padding : 4px 8px 4px 8px;
        width : 330px;
    }

    .layer_wrap {
        position:absolute;
        width:100vw;
        height:100vh;
        left:0;
        top:0;
        z-index:99;
        background-color : rgba(5,5,5,0.75);
        display:none;
    }
    .layer_wrap iframe {
        position:absolute;
        border : 1px solid #aaaaaa;
        width: 800px;
        height: 500px;
        z-index:100;
        left:50%;
        top:50%;
        transform:translate(-50%,-50%);
        background-color:white;
        display:none;
    }
    .layer_wrap .btn_layer_close {
        position:absolute;
        padding:4px 8px 4px 8px;
        left:calc(50% + 400px - 20px);
        top:calc(50% - 250px + 20px);
        transform:translate(-50%,-50%);
        z-index:101;
        display:none;
    }
</style>

<div class="layer_wrap">
    <iframe name="layer_iframe" id="layer_iframe" frameborder="0" src="" width="100%" height="100%" ></iframe>
    <button class="btn_layer_close" onClick="closeLayer();">X</button>
</div>

<div class="backup_wrap">

    <div class="new_backup_wrap">
        <input class="text" name="newFileName" placeholder="다른 이름으로 생성" />
        <button class="btn_execute_backup">새 백업 생성</button>
    </div>

    <table class="fileList">
        <tr>
            <th>파일명</th>
            <th>파일크기</th>
            <th>최종 수정일</th>
            <th></th>
        </tr>
        <?php foreach($fileList as $_k => $eachFile) { ?>
        <tr>
            <td><?= $eachFile["fileName"]; ?></td>
            <td><?= $eachFile["fileSize"]; ?></td>
            <td><?= $eachFile["modDt"]; ?></td>
            <td><button class="btn_download" data-file-name="<?= $eachFile['fileName'] ?>">Download</button></td>
        </tr>
         <?php } ?>
    </table>
</div>

<form id="frm_backup" target="ifrmProcess" action="./backup_download">
    <input type="hidden" name="fileName" value="" />
</form>

<script>
    $(".btn_download").on('click', function() {
        $("#frm_backup").attr("action", "./backup_download");
        $("#frm_backup").attr("target", "ifrmProcess");
        $("input[name=fileName]").val($(this).data("file-name"));
        $('#frm_backup')[0].submit();
    });

    $(".btn_execute_backup").on('click', function() {
        $("#frm_backup").attr("action", "./backup_execute");
        $("#frm_backup").attr("target", "layer_iframe");
        var newFileName = $("input[name=newFileName]").val();
        $("input[name=fileName]").val(newFileName);
        $('#frm_backup')[0].submit();
        openLayer();
    });

    function openLayer() {
        $(".layer_wrap, .layer_wrap iframe, .layer_wrap .btn_layer_close").css("display", "unset");
    }
    function closeLayer() {
        $(".layer_wrap, .layer_wrap iframe, .layer_wrap .btn_layer_close").css("display", "none");
        document.location.href = document.location.href;
    }
</script>


