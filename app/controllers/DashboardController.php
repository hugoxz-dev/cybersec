<?php

class DashboardController extends Controller
{
    private User $userModel;

    private Activity $activityModel;

    public function __construct()
    {
        $this->userModel = new User();

        $this->activityModel = new Activity();
    }

    public function index(): void
    {
        Auth::requireLogin();

        $userId = Auth::id();

        $stats = $this->userModel
            ->getDashboardStats(
                $userId
            );

        $activities = $this->activityModel
            ->getRecentByUser(
                $userId
            );

        $this->view(
            'dashboard/index',
            [
                'stats' => $stats,
                'activities' => $activities
            ]
        );
    }
}