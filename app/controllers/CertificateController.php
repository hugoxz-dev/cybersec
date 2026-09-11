<?php

class CertificateController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();

        $certificateModel =
            new Certificate();

        $certificate =
            $certificateModel
                ->findByUser(
                    Auth::id()
                );

        $this->view(
            'certificate/index',
            [
                'certificate' => $certificate
            ]
        );
    }

    public function generate(): void
    {
        Auth::requireLogin();

        $userModel =
            new User();

        $solved =
            $userModel
                ->countSolvedChallenges(
                    Auth::id()
                );

        if ($solved < 5) {

            Session::set(
                'error',
                'Resolva pelo menos 5 desafios.'
            );

            $this->redirect(
                'certificate'
            );
        }

        $certificateModel =
            new Certificate();

        $exists =
            $certificateModel
                ->findByUser(
                    Auth::id()
                );

        if (!$exists) {

            $certificateModel
                ->generate(
                    Auth::id()
                );
        }

        $this->redirect(
            'certificate'
        );
    }
}