<?php
class NewsFeed
{

	private $result;
	public $code;
	public $link;


	public function checkUrl($link)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0");
		$result = curl_exec($ch);
		$this->result = $result;
		$this->code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return $link;
	}
	public function loadXML()
	{
		$xml = @simplexml_load_string($this->result);
		if(is_object($xml) && isset($xml->channel->item)){
			$number = 0;

			if($this->code === 200 || $this->code === 301 || $this->code === 302)
			{
				echo "<div class='col text-center'>
				<h5>
				Strona odpowiedziała kod " . $this->code . "
				</h5>
				</div>";
				foreach($xml->channel->item as $item){
					echo $this->link;
					if($number < 5){
						$title   = $item->title;
						$dateNew = new DateTime($item->pubDate);
						$date    = $dateNew->format('Y-m-d H:i:s');
						$desc    = $item->description;
						$link    = $item->link;
						$dir     = 0;
						$this->checkLink($title,$date,$desc,$link,$dir);
						$number++;
						echo "<tr><td>$number</td><td>$title</td><td>$date</td><td>$desc</td></tr>";
					}
				}
			}

		}
	}
	public function loadXmoon()
	{
		$xml = @simplexml_load_string($this->result);
		if(is_object($xml) && isset($xml->entry)){
			$number = 0;
			if($this->code === 200 || $this->code === 301 || $this->code === 302)
			{
				echo "<div class='col text-center'>
				<h5>
				Strona odpowiedziała kod " . $this->code . "
				</h5>
				</div>";
				foreach($xml->entry as $item){

					if($number < 5){
						$title = $item->title;
						$date  = $item->published;
						$desc  = $item->content;
						$link  = $item->id;
						$dir   = 1;
						$this->checkLink($title,$date,$desc,$link,$dir);
						$number++;
						echo "<tr><td>$number</td><td>$title</td><td>$date</td><td>$desc</td></tr>";
					}
				}
			}

		}
	}
	public function checkLink($title,$date,$desc,$link,$dir)
	{
		$this->logData("Skrypt Rss został rozpoczęty !");
		include('connect.php');
		$stmt = $pdo->prepare("SELECT count(*) FROM rss_added WHERE rss_title = ?");
		$stmt->execute([$title]);
		$row  = $stmt->fetchColumn();
		if($row < 1)
		{
			$stmt   = $pdo->prepare("INSERT INTO rss_added (`rss_title`, `rss_desc`, `rss_date`, `rss_link`, `rss_dir`) VALUES (?,?,?,?,?)");
			$stmt->execute([$title, $desc, $date, $link, $dir]);
			$result = $stmt->fetchAll();
			$id     = $pdo->lastInsertId();
			if(!empty($id)){
				$this->logData("Dodano artukuł o id = $id");
			}

		}
		$this->logData("Skrypt Rss został zakończony !");
	}
	public function viewRssXml()
	{
		include('connect.php');
		$stmt   = $pdo->prepare("SELECT * FROM rss_added WHERE rss_dir = 0 ORDER BY rss_id ASC");
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row)
		{
			$id    = $row['rss_id'];
			$title = $row['rss_title'];
			$date  = $row['rss_date'];
			$desc  = $row['rss_desc'];
			$added = $row['rss_added'];

			echo "<tr><td>$id</td><td>$title</td><td>$desc</td><td>$date</td><td>$added</td></tr>";
		}
	}
	public function viewXmoon()
	{
		include('connect.php');
		$stmt   = $pdo->prepare("SELECT * FROM rss_added WHERE rss_dir = 1 ORDER BY rss_id ASC");
		$stmt->execute();
		$result = $stmt->fetchAll();

		foreach($result as $row)
		{
			$id    = $row['rss_id'];
			$title = $row['rss_title'];
			$date  = $row['rss_date'];
			$desc  = $row['rss_desc'];
			$added = $row['rss_added'];
			$this->logData("Dodano artukuł o id = $id");
			echo "<tr><td>$id</td><td>$title</td><td>$desc</td><td>$date</td><td>$added</td></tr>";
		}

	}
	public function txtFile($add,$text)
	{
		$file = fopen('log.txt','a');
		$new  = " [ " . $add . " ] - " . $text . "\r\n";
		fwrite($file, $new);
		fclose($file);
	}
	public function logData($info)
	{
		$now = (new DateTime('now'))->format('Y-m-d H:i:s');
		$this->txtFile($now,$info);
	}
}


?>


