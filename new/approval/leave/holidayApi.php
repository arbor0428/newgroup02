<?

/**
 * �ۼ���¥: 2022.07.11
 * API ����: �������������� �ѱ�õ��������_Ư�� ���� ����API
 * ��� ���: ������ ���� ��ȸ
 * ��ũ: https://www.data.go.kr/data/15012690/openapi.do
 * ����: iwebzone ���̹� ���� �α���
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
