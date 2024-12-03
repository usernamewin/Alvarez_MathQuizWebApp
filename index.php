<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz</title>
</head>
<body>
    <h1>Math Quiz</h1>
    <h2>Settings</h2>

    <form action="">
        <label>Operator:</label><br>
        <input type="radio" id="addition" name="operator" value="addition" required>
        <label for="addition">Addition</label><br>
        <input type="radio" id="subtraction" name="operator" value="subtraction" required>
        <label for="subtraction">Subtraction</label><br>
        <input type="radio" id="multiplication" name="operator" value="multiplication" required>
        <label for="multiplication">Multiplication</label><br><br>

        <label>Level:</label><br>
        <input type="radio" id="easy" name="level" value="1" required>
        <label for="easy">Easy</label><br>
        <input type="radio" id="moderate" name="level" value="2" required>
        <label for="moderate">Moderate</label><br>
        <input type="radio" id="hard" name="level" value="3" required>
        <label for="hard">Hard</label><br><br>

        <label for="items">Number of Item: </label>
        <input type="number" name="items" id="items" min="1" max="50" required><br><br>

        <label for="difference">Max Difference of choices from the correct answer: </label>
        <input type="number" name="difference" id="difference" min="1" max="10" required><br><br>

        <button type="submit">Start Quiz</button>
    </form>
</body>
</html>