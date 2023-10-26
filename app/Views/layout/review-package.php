<!-- Object Rating and Review -->
<div class="card">
    <div class="card-header text-center">
        <h4 class="card-title">Rating and Review</h4>
        <!-- <?php if (in_groups('user')) : ?>
            <form class="form form-vertical" id="formReview" method="POST">
                <div class="form-body">
                    <div class="star-containter mb-3">
                        <i class="fa-solid fa-star fs-5" id="star-1" onclick="setRating('<?= user()->id ?>','<?= $data['id']; ?>','1','<?= $url ?>');"></i>
                        <i class="fa-solid fa-star fs-5" id="star-2" onclick="setRating('<?= user()->id ?>','<?= $data['id']; ?>','2','<?= $url ?>');"></i>
                        <i class="fa-solid fa-star fs-5" id="star-3" onclick="setRating('<?= user()->id ?>','<?= $data['id']; ?>','3','<?= $url ?>');"></i>
                        <i class="fa-solid fa-star fs-5" id="star-4" onclick="setRating('<?= user()->id ?>','<?= $data['id']; ?>','4','<?= $url ?>');"></i>
                        <i class="fa-solid fa-star fs-5" id="star-5" onclick="setRating('<?= user()->id ?>','<?= $data['id']; ?>','5','<?= $url ?>');"></i>
                        <p class="card-text" id="rateText"></p>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px;" name="comment" required></textarea>
                            <label for="floatingTextarea">Leave a comment here</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end mb-3">
                        <input type="hidden" name="user_id" value="<?= user()->id ?>">
                        <input type="hidden" name="object_id" value="<?= $data['id'] ?>">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                    </div>
                </div>
            </form>
        <?php endif; ?> -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="reviews">
                <tbody id="commentBody">
                    <?php if (isset($data['reviews'])) : ?>
                        <?php foreach ($data['reviews'] as $review) : ?>
                            <?php if ($review['rating'] != null || $review['review'] != null) : ?>
                                <tr>
                                    <td>
                                        <?php if (isset($review['rating'])) : ?>
                                            <div class="star-containter mb-3">
                                                <i class="fa-solid fa-star fs-10" id="star-1"></i>
                                                <i class="fa-solid fa-star fs-10" id="star-2"></i>
                                                <i class="fa-solid fa-star fs-10" id="star-3"></i>
                                                <i class="fa-solid fa-star fs-10" id="star-4"></i>
                                                <i class="fa-solid fa-star fs-10" id="star-5"></i>

                                            </div>
                                            <script>
                                                setStar("<?= $review['rating']; ?>")
                                            </script>
                                        <?php endif; ?>
                                        <p class="mb-0"><?= $review['name']; ?> </p>
                                        <p class="fw-light"><?= $review['date']; ?></p>
                                        <p class="fw-bold"><?= $review['review']; ?></p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>