<?php

session_start();

$operator = $_POST["operator"];
$level = $_POST["level"];
$items = intval($_POST["items"]);
$difference = intval($_POST["difference"]);

$difficulty = [
    "1" => [1, 9],
    "2" => [10, 99],
    "3" => [100, 999]
];

$range = $difficulty[$level];

$questions = [];
for ($i = 0; $i < $items; $i++) {
    $num1 = rand($range[0], $range[1]);
    $num2 = rand($range[0], $range[1]);
    $answer = 0;

    switch ($operator) {
        case "addition":
            $question = "$num1 + $num2";
            $answer = $num1 + $num2;
            break;
        case "subtraction":
            $question = "$num1 - $num2";
            $answer = $num1 - $num2;
            break;
        case "multiplication":
            $question = "$num1 * $num2";
            $answer = $num1 * $num2;
            break;
    }

    $options = [$answer];
    while (count($options) < 4) {
        $choice = $answer + rand(-$difference, $difference);
        if (!in_array($choice, $options) && $choice >= 0) {
            $options[] = $choice;
        }
    }
    shuffle($options);

    $questions[] = [
        "question" => $question,
        "answer" => $answer,
        "options" => $options
    ];
}

$_SESSION["correct"] = $_SESSION["correct"] ?? 0;
$_SESSION["wrong"] = $_SESSION["wrong"] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz</title>
</head>
<body>
    <h1>Math Quiz</h1>

    <div id="quiz">
        <h2 id="question"></h2>
        <div id="options"></div>
    </div>

    <div id="score">
        <p id="correct">Correct Answers: <?php echo $_SESSION["correct"]; ?></p>
        <p id="wrong">Wrong Answers: <?php echo $_SESSION["wrong"]; ?></p>
        
        <button id="retake" onclick="location.href='index.php'" style="display: none;">Retake Quiz</button>
    </div>

    <button id="end" onclick="endQuiz()">End Quiz</button>

    <script>
        const questions = <?php echo json_encode($questions); ?>;
        let current = 0;
        let correct = <?php echo $_SESSION["correct"]; ?>;
        let wrong = <?php echo $_SESSION["wrong"]; ?>;

        function loadQuestion() {
            if (current >= questions.length) {
                endQuiz();
                return;
            }
            const { question, options } = questions[current];
            document.getElementById("question").innerText = question;
            const optionsDiv = document.getElementById("options");
            optionsDiv.innerHTML = '';
            options.forEach(option => {
                const button = document.createElement("button");
                button.innerText = option;
                button.onclick = () => checkAnswer(option === questions[current].answer);
                optionsDiv.appendChild(button);
            });
        }

        function checkAnswer(isCorrect) {
            if (isCorrect) correct++;
            else wrong++;
            current++;
            document.getElementById("correct").innerText = `Correct Answers: ${correct}`;
            document.getElementById("wrong").innerText = `Wrong Answer: ${wrong}`;
            loadQuestion();
        }

        function endQuiz() {
            const percentage = (correct / (correct + wrong)) * 100 || 0;
            document.getElementById("quiz").innerHTML = `<p>Score: ${percentage.toFixed(1)}%</p>`;
            document.getElementById("retake").style.display = "inline-block";
            document.getElementById("end").style.display = "none";
        }

        document.addEventListener('DOMContentLoaded', loadQuestion);
    </script>
</body>
</html>