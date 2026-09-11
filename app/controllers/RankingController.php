<?php

class RankingController extends Controller
{
    private Ranking $rankingModel;

    public function __construct()
    {
        $this->rankingModel = new Ranking();
    }

    public function index(): void
    {
        Auth::requireLogin();

        $ranking =
            $this->rankingModel
                ->getRanking();

        $this->view(
            'ranking/index',
            [
                'ranking' => $ranking
            ]
        );
    }
}