$(document).ready(function() {
    let newRowCount = 0;
    // 新しく追加: 追加ボタンのクリックイベント
    $('#banner_create').click(function() {
        newRowCount++;
        const newRow = `
            <div class="banner_row">
                <div class="banner_row-img"><img src="${placeholderImageUrl}" alt="新規バナー画像"></div>
                <input type="file" name="new_images[]" class="banner-image-input" required>
                <button type="button" class="banner_row-destroy">
                    <img src="${removeButtonImageUrl}" alt="削除アイコン">
                </button>
            </div>
        `;
        $('.banner_rows').append(newRow);
    });

    $(document).on('change', '.banner-image-input', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $(this).closest('.banner_row').find('.banner_row-img img').attr('src', e.target.result);
            }.bind(this);
            reader.readAsDataURL(file);
        }
    });

    // 新しく追加: 動的に追加された要素も含めて、削除ボタンのクリックイベントを設定
    $(document).on('click', '.banner_row-destroy', function() {
        if (confirm('このバナーを削除してもよろしいですか？')) {
            $(this).closest('.banner_row').remove();
        }
    });

    // 新しく追加: フォーム送信のイベント
    $('#banner_form').submit(function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        var hasNewImages = false;

        // 新しい画像が追加されているかチェック
        $('input[name^="new_images"]').each(function() {
            if (this.files.length > 0) {
                hasNewImages = true;
                return false; // ループを抜ける
            }
        });

        if (!hasNewImages) {
            alert('画像が選択されていません');
            return;
        }
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('バナーが正常に更新されました');
                location.reload();
            },
            error: function(xhr) {
                alert('エラーが発生しました: ' + xhr.responseText);
            }
        });
    });
});