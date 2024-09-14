// 学年ボタン関係の制御
$(document).ready(function() {
    const $gradeButtons = $('.grade__btn button');
    const $selectedGradeElement = $('.grade__btn--display');

    // 初期状態の背景色を設定
    const $initialButton = $gradeButtons.filter(function() {
        return $(this).text() === $selectedGradeElement.text();
    });
    if ($initialButton.length) {
        const initialButtonStyle = window.getComputedStyle($initialButton[0]);
        $selectedGradeElement.css('background', initialButtonStyle.background);
    }

    // 初期状態で選択されているボタンを探す
    
    $gradeButtons.on('click', function() {
        const gradeName = $(this).data('grade');
        $selectedGradeElement.text(gradeName);

        // ボタンの背景色を取得
        const buttonStyle = window.getComputedStyle(this);
        const background = buttonStyle.background;

        // selectedGradeElementにスタイルを適用
        $selectedGradeElement.css('background', background);
        
        // 選択されたボタンにアクティブクラスを追加し、他から削除
        $gradeButtons.removeClass('active');
        $(this).addClass('active');
        
        console.log('Selected grade:',gradeName);
    });

    const initialGrade = $selectedGradeElement.text();
    $gradeButtons.filter(function(){
        return $(this).text() === initialGrade;
    }).addClass('active');

    // 現在の日付を取得
    let currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth() + 1; // JavaScriptの月は0-11なので+1する

    // 初期表示を設定
    updateScheduleTitle(currentYear, currentMonth);

    // 前の月へ
    $('.schedule__back').on('click', function() {
        currentMonth--;
        if (currentMonth < 1) {
            currentMonth = 12;
            currentYear--;
        }
        updateScheduleTitle(currentYear, currentMonth);
    });

    // 次の月へ
    $('.schedule__next').on('click', function() {
        currentMonth++;
        if (currentMonth > 12) {
            currentMonth = 1;
            currentYear++;
        }
        updateScheduleTitle(currentYear, currentMonth);
    });

    // スケジュールタイトルを更新する関数
    function updateScheduleTitle(year, month) {
        $('#scheduleYear').text(year);
        $('#scheduleMonth').text(month);
    }
});
