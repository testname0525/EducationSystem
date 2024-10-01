$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
    const $prevMonthBtn = $('.schedule__back');
    const $nextMonthBtn = $('.schedule__next');
    const $scheduleYear = $('#scheduleYear');
    const $scheduleMonth = $('#scheduleMonth');
    const $gradeButtons = $('.grade__btn button');
    const $selectedGradeElement = $('.grade__btn--display');
    const $curriculumCards = $('#curriculumCards');
    const initialBackground = $selectedGradeElement.data('initial-background');

    let currentDate = new Date(initialData.year, initialData.month - 1);
    let currentGradeId = initialData.gradeId;

    function updateScheduleTitle() {
        $scheduleYear.text(currentDate.getFullYear());
        $scheduleMonth.text(currentDate.getMonth() + 1);
    }

    if (initialBackground) {
        $selectedGradeElement.css('background', initialBackground);
    }

    function fetchCurriculums() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth() + 1;
        
        console.log('Fetching curriculums:', { year, month, grade_id: currentGradeId });

        $.ajax({
            url:initialData.baseUrl + "/user/curriculum_list" ,
            method: 'GET',
            data: { year: year, month: month, grade_id: currentGradeId },
            success: function(data) {
                if (data.html) {
                    $curriculumCards.html(data.html);
                } else {
                $curriculumCards.empty();
                console.log('No curriculum data found for the selected criteria');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
                console.log('Response:', xhr.responseText);
                $curriculumCards.html('<p>カリキュラムの取得に失敗しました。再度お試しください。</p>');
            }
        });
    }

    $prevMonthBtn.on('click', function() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateScheduleTitle();
        fetchCurriculums();
    });

    $nextMonthBtn.on('click', function() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateScheduleTitle();
        fetchCurriculums();
    });

    $gradeButtons.on('click', function() {
        const gradeName = $(this).data('grade');
        currentGradeId = $(this).data('grade-id');
        $selectedGradeElement.text(gradeName);

        const buttonStyle = window.getComputedStyle(this);
        const background = buttonStyle.background;

        $selectedGradeElement.css('background', background);
        
        $gradeButtons.removeClass('active');
        $(this).addClass('active');
        
        fetchCurriculums();
    });

    updateScheduleTitle();
    fetchCurriculums();
});
