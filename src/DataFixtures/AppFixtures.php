<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private string $wordBank = "Reprehenderit enim anim reprehenderit est sit velit nulla voluptate Enim nostrud reprehenderit fugiat exercitation Elit voluptate est dolore velit adipisicing est qui fugiat proident aliqua Quis eu consectetur mollit laborum tempor ullamco excepteur amet reprehenderit nostrud ex Cillum minim consequat fugiat irure sit sint duis exercitation mollit consequat et est Quis in pariatur do nulla ut fugiat veniam Laborum laborum et occaecat excepteur enim proident ea labore laboris qui occaecat nostrud
    ";

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $article = new Article();
            $article->setTitre($this->getRandomWords(8));
            $article->setContenu($this->getRandomWords(300));
            $article->setImageName("Sample.png");
            $article->setCreatedAt(new \DateTimeImmutable());
            $article->setUpdatedAt(new \DateTime());

            $manager->persist($article);
        }

        $manager->flush();
    }

    private function getRandomWords(int $count): string
    {
        $words = explode(' ', $this->wordBank);
        shuffle($words);

        $needed = $count - count($words);
        while ($needed > 0) {
            $words = array_merge($words, $words);
            $needed = $count - count($words);
        }

        return implode(' ', array_slice($words, 0, $count));
    }
}
