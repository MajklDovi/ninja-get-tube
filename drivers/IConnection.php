interface IConnection {
    public function prepare($prepareString);
    public function query();
}