<?php

namespace UserBundle\Service;

use FOS\UserBundle\Model\UserInterface;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Exception\InvalidArgumentException;


class Gravatar
{
    /**
     * @param UserInterface $user
     * @return UploadedFile
     */
    public function getUserFile(UserInterface $user)
    {
        return $this->getFile($user->getEmail());
    }

    /**
     * @param string $email
     * @return UploadedFile
     * @throws InvalidArgumentException
     */
    public function getFile($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException();
        }
        $hash = md5(strtolower(trim($email)));


        $guzzle = new Client();
        $tempDirectory = sys_get_temp_dir();
        $guzzle->request(
            "GET",
            "http://gravatar.com/avatar/".$hash."?d=404",
            [RequestOptions::SINK => $tempDirectory.'/'.$hash]
        );

        $file = new File($tempDirectory.'/'.$hash);
        $fileOriginalName = $hash.'.'.$file->guessExtension();
        $file = new UploadedFile(
            $tempDirectory.'/'.$hash,
            $fileOriginalName,
            $file->getMimeType(),
            $file->getSize(),
            null,
            true
        );

        return $file;
    }

}
