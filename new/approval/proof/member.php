<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="member_ok.php" method="post">
        <p>
            <label for="">이름</label>
            <input type="text" name="name">
        </p>
        <p>
            <label for="">주민번호</label>
            <input type="text" name="securi01"> - <input type="text" name="securi02">
        </p>
        <p>
            <label for="">주소</label>
            <input type="text" name="addr">
        </p>
        <p>
            <label for="">소속</label>
            <input type="text" name="team">
        </p>
        <p>
            <label for="">직급</label>
            <input type="text" name="mname">
        </p>
        <p>
            <label for="">입사일</label>
            <input type="text" name="entry_date">
        </p>
        <input type="submit" value="저장">
    </form>
</body>
</html>