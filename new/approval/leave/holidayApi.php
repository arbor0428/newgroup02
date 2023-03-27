<?

/**
 * 작성날짜: 2022.07.11
 * API 설명: 공공데이터포털 한국천문연구원_특일 정보 오픈API
 * 사용 기능: 공휴일 정보 조회
 * 링크: https://www.data.go.kr/data/15012690/openapi.do
 * 계정: iwebzone 네이버 연동 로그인
 */
function getHoliday()
{
  $ch = curl_init();
  $url = 'http://apis.data.go.kr/B090041/openapi/service/SpcdeInfoService/getRestDeInfo';
  $queryParams = '?'  . urlencode('serviceKey') . '=9uFz0HVKCTTBOVpT3vV%2Fou%2BgLJ404m8gdtLZp2MxNGQ8kWnXt3brayroKSk4mAasLRAD4oj8qCNawiQ0JxYeHQ%3D%3D';
  $queryParams .= '&' . urlencode('pageNo')     . '=' . urlencode('1');
  $queryParams .= '&' . urlencode('numOfRows')  . '=' . urlencode('999');
  $queryParams .= '&' . urlencode('solYear')    . '=' . urlencode('2020');

  curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
  $response = curl_exec($ch);
  curl_close($ch);

  $xml = simplexml_load_string($response);
  $json = json_encode($xml);
  $data = json_decode($json, TRUE);

  return $data;
}
