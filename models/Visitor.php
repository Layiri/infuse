<?php


/**
 * Class Visitor for save and update Data
 * @property int $ip_address
 * @property string $user_agent
 * @property string $view_date
 * @property string $page_url
 * @property int $views_count
 *
 * @property PDO $db
 * @property string $table
 */
class Visitor
{

    public $table = 'user_visitors';

    public string $ip_address;
    public string $user_agent;
    public string $view_date;
    public string $page_url;
    public int $views_count;


    /**
     * User constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Insert visitor data
     * @return bool
     */
    public function save()
    {
        $req = $this->db->prepare('INSERT INTO ' . $this->table . '(ip_address,user_agent,view_date,page_url,views_count) VALUES(:ip_address, :user_agent, :view_date, :page_url, :views_count)');
        $req->execute(array(
            'ip_address' => $this->ip_address,
            'user_agent' => $this->user_agent,
            'view_date' => date("Y-m-d H:i:s"),
            'page_url' => $this->page_url,
            'views_count' => 1
        ));
        return true;
    }

    /**
     * Update visitor data
     * @return bool
     */
    public function update()
    {
        $req = $this->db->prepare('UPDATE ' . $this->table . ' SET view_date=:view_date,views_count=:views_count WHERE ip_address=:ip_address AND user_agent=:user_agent AND page_url=:page_url');
        $req->execute([
            'view_date' => date("Y-m-d H:i:s"),
            'views_count' => $this->views_count,
            'ip_address' => $this->ip_address,
            'user_agent' => $this->user_agent,
            'page_url' => $this->page_url
        ]);
        return true;
    }

    /**
     * Get one visitor
     * @param string $ip_address
     * @param string $user_agent
     * @param string $page_url
     * @return array
     */
    public function one(string $ip_address, string $user_agent, string $page_url)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE `ip_address`=:ip_address AND `user_agent` LIKE :user_agent AND `page_url` LIKE :page_url";
        $req = $this->db->prepare($query);
        $req->bindParam(':ip_address', $ip_address);
        $req->bindParam(':user_agent', $user_agent);
        $req->bindParam(':page_url', $page_url);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);
        return $req->fetch();
    }

}